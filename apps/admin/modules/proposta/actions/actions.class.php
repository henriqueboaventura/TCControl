<?php

/**
 * proposta actions.
 *
 * @package    TCCtrl
 * @subpackage proposta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propostaActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request)
    {                
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');

        $this->proposta = Doctrine_Core::getTable('Proposta')->findPropostaAluno($aluno,false);
        
        $comentarios = array();
        foreach($this->proposta->Comentarios as $comentario){
            $comentarios[$comentario->local][] = $comentario;
        }
        
        $this->comentarios = $comentarios;
        
        if($this->proposta){
            $this->form = new PropostaForm($this->proposta);
        } else {
            $this->form = new PropostaForm();
            $this->form->setDefault('aluno_id', $aluno);
        }
        
        if($request->isMethod(sfRequest::POST) OR $request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()), 
                $request->getFiles($this->form->getName())
            );
            
            if($this->form->isValid()){ 
                $this->form->save();
                $this->getUser()->setFlash('success','Proposta ' . ($this->form->isNew() ? 'incluída' : 'alterada') . ' com sucesso!', false);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);    
            }
            
        } 
    }

    public function executeList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine::getTable('Proposta')->findPropostaByProfessor($this->getUser()->getAttribute('id',null,'usuario'),$request->getParameter('filtro'),false);
        $this->pager = new sfDoctrinePager('Proposta',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->propostas = $this->pager->getResults();

        $this->coordenador = $request->getParameter('coordenador', false);
    }

    public function executeView(sfWebRequest $request)
    {
        $this->proposta = Doctrine::getTable('Proposta')->findPropostaCronogramas($request->getParameter('id'));
        $this->avaliacao = $request->getParameter('avaliacao', false);

        if($this->avaliacao == true){
            $versao = $this->proposta->Avaliacao->versao_proposta;
            $this->proposta->revert($versao);
        }

        $this->etapa = array();
        foreach($this->proposta->Cronogramas as $cronograma){
            $this->etapa[$cronograma->etapa][] = $cronograma;
        }

        
    }

    public function executeAvaliacao(sfWebRequest $request)
    {
        $proposta = Doctrine::getTable('Proposta')->find($request->getParameter('id'));

        $propostaAvaliacao = new PropostaAvaliacao();
        $propostaAvaliacao->versao_proposta = $proposta->version;

        $proposta->Avaliacao = $propostaAvaliacao;
        $proposta->save();

        $this->getUser()->setFlash('success','Proposta enviada para avaliação!');
        $this->redirect('@proposta');
    }

    public function executeParecer(sfWebRequest $request)
    {
        $this->propostaAvaliacao = Doctrine::getTable('PropostaAvaliacao')->findOneByPropostaId($request->getParameter('id'));
        $this->form = new PropostaAvaliacaoForm($this->propostaAvaliacao);
        $this->form->setDefault('aprovada', ($request->getParameter('acao') == 'aceitar') ? true : false);

        if($request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()),
                $request->getFiles($this->form->getName())
            );

            if($this->form->isValid()){
                $this->form->save();
                if($request->getParameter('acao') == 'aceitar'){
                    $this->getUser()->setFlash('success','Proposta aceita com sucesso!');
                } else {
                    $this->getUser()->setFlash('success','Proposta rejeitada com sucesso!');
                }
                $this->redirect('@proposta_list?filtro=aguardando');
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
                
            }
        }
    }
    
    public function executeNewComment(sfWebRequest $request)
    {
        $this->comentarios = Doctrine::getTable('PropostaComentario')->getComentariosByLocal(
            $request->getParameter('proposta_id'),
            $request->getParameter('local')
        );
        

        $this->form = new PropostaComentarioForm();
        $this->form->setDefaults(array(
            'proposta_id' => $request->getParameter('proposta_id'),
            'local'       => $request->getParameter('local'),
            'lido'        => false,
        ));
        
        if($request->isMethod(sfRequest::POST)){
            $this->form->bind(
                $request->getParameter($this->form->getName()), 
                $request->getFiles($this->form->getName())
            );
            
            if($this->form->isValid()){ 
                $comentario = $request->getParameter('proposta_comentario');
                                
                $this->form->save();
                $this->getUser()->setFlash('success','Comentário adicionado com sucesso!');
                $this->redirect('@proposta_view?id=' . $comentario['proposta_id']);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);    
            }
        }
    }
    
    public function executeViewComments(sfWebRequest $request)
    {
        $this->proposta = Doctrine_Core::getTable('Proposta')->findPropostaComentarios($request->getParameter('proposta_id'), $request->getParameter('local'),false);
    }
    
    public function executeMarkAsRead(sfWebRequest $request)
    {
        $comentario = Doctrine::getTable('PropostaComentario')->find($request->getParameter('comentario_id'));
        $comentario->lido = true;
        $comentario->save();
        
        $this->getUser()->setFlash('success','Comentário marcado como lido!');
        $this->redirect('@proposta_view_comment?proposta_id=' . $request->getParameter('proposta_id') . '&local=' . $comentario->local);
    }
}
