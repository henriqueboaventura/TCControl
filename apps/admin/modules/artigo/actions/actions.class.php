<?php

/**
 * artigo actions.
 *
 * @package    TCCtrl
 * @subpackage artigo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class artigoActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request)
    {                
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');

        if(!($this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno,false))){
            $this->artigo = new Artigo();
            $this->artigo->Aluno = Doctrine::getTable('Aluno')->find($aluno);
            $this->artigo->save();
        }
                
        if($this->artigo){
            $this->form = new ArtigoForm($this->artigo);
        } else {
            $this->form = new ArtigoForm();
            $this->form->setDefault('aluno_id', $aluno);
        }
        
        if($request->isMethod(sfRequest::POST) OR $request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()), 
                $request->getFiles($this->form->getName())
            );
            
            if($this->form->isValid()){ 
                $this->form->save();
                $this->getUser()->setFlash('success','Artigo ' . ($this->form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!', false);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);    
            }
            
        } 
    }
    
    public function executeList(sfWebRequest $request)
    {
        switch($request->getParameter('filtro')){
        case 'aguardando':
            $status = array(0);

            break;
        case 'aprovado':
            $status = array(1);

            break;
        case 'rejeitado':
            $status = array(2);

            break;
        default:
            $status = array(0,1,2);
        }

        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        if($request->getParameter('filtro', false)){
            $query = Doctrine::getTable('Artigo')->findArtigoByProfessor($this->getUser()->getAttribute('id',null,'usuario'),$status,false);
        } else {
            $query = Doctrine::getTable('Artigo')->createQuery('a');
        }
        $this->pager = new sfDoctrinePager('Proposta',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->artigos = $this->pager->getResults();

        $this->coordenador = $request->getParameter('coordenador', false);
    }

    public function executeHistorico(sfWebRequest $request)
    {
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');
        $versao = $request->getParameter('versao', null);
        
        $this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno, false);

        if($versao != null){
            $this->versaoFinal = $this->versaoInicial = $this->artigo->revert($versao);
            if($versao != 1){
                $reverted = clone($this->artigo);
                $this->versaoFinal = $reverted->revert($versao - 1);
            } 
        } else {
            $this->versaoFinal = $this->versaoInicial = $this->artigo;
            if($this->artigo->version != 1){
                $reverted = clone($this->artigo);
                $this->versaoFinal = $reverted->revert($this->artigo->version - 1);
            }
        }

        $this->versoes = Doctrine::getTable('Artigo')->findVersoesArtigo($this->artigo->id);

        $f1 = ($this->versaoInicial->conteudo);
        $f2 = ($this->versaoFinal->conteudo);
        $lines1 = explode("\n",$f1);
        $lines2 = explode("\n",$f2);

        $diff = new Text_Diff('auto',array($lines2, $lines1));
        $renderer = new Text_Diff_Renderer_inline();
        
        $this->diff = $renderer->render($diff);
    }

    public function executeBackHistory(sfWebRequest $request)
    {
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');
        $versao = $request->getParameter('versao', null);

        $artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno, false);
        $artigo->revert($versao);
        $artigo->save();

        $this->getUser()->setFlash('success', 'Artigo revertido para a versão ' . $versao);

        $this->redirect('@artigo_history');
    }

    public function executeView(sfWebRequest $request)
    {
        $this->artigo = Doctrine::getTable('Artigo')->find($request->getParameter('id'));
    }

    public function executeNewComment(sfWebRequest $request)
    {
        $this->comentarios = Doctrine::getTable('ArtigoComentario')->findByArtigo($request->getParameter('artigo_id'));

        $this->form = new ArtigoComentarioForm();
        $this->form->setDefaults(array(
            'artigo_id' => $request->getParameter('artigo_id'),
            'lido'        => false,
        ));

        if($request->isMethod(sfRequest::POST)){
            $this->form->bind(
                $request->getParameter($this->form->getName()),
                $request->getFiles($this->form->getName())
            );

            if($this->form->isValid()){
                $comentario = $request->getParameter('artigo_comentario');

                $this->form->save();
                $this->getUser()->setFlash('success','Comentário adicionado com sucesso!');
                $this->redirect('@artigo_view?id=' . $comentario['artigo_id']);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
            }
        }
    }

    public function executeViewComments(sfWebRequest $request)
    {
        $this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoComentarios($request->getParameter('artigo_id'), false);
    }

    public function executeMarkAsRead(sfWebRequest $request)
    {
        $comentario = Doctrine::getTable('ArtigoComentario')->find($request->getParameter('comentario_id'));
        $comentario->lido = true;
        $comentario->save();

        $this->getUser()->setFlash('success','Comentário marcado como lido!');
        $this->redirect('@artigo_view_comment?artigo_id=' . $request->getParameter('artigo_id'));
    }
}
