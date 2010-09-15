<?php

/**
 * orientacao actions.
 *
 * @package    TCCtrl
 * @subpackage orientacao
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orientacaoActions extends sfActions
{
    public function executeOrientadorList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Professor')->createQuery('a');
        $this->pager = new sfDoctrinePager('Professor',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->professors= $this->pager->getResults();
    }
    
    public function executeOrientandosList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Orientacao')->findAlunosOrientacao($this->getUser()->getAttribute('id',null,'usuario'),array(0),false);
        $this->pager = new sfDoctrinePager('Orientacao',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->alunos = $this->pager->getResults();

        $this->showActions = true;
        if(!$this->getUser()->getAttribute('coordenador',false,'professor')){
            $orientacoes = Doctrine_Core::getTable('Orientacao')->findOrientacoes($this->getUser()->getAttribute('id',null,'usuario'),null,1);
            if(count($orientacoes) >= $this->getUser()->getAttribute('alunos_por_professor',0,'configuracao')){
                $this->getUser()->setFlash('warning', 'Seu número de orientandos atingiu o valor máximo definido pelo professor coordenador, o aceite deverá ser efetuado por ele.');
                $this->showActions = false;
            }
        } 
    }

    public function executeSolicitar(sfWebRequest $request)
    {
        //verifica se o aluno ainda nao solicitou uma orientacao
        $orientacao = Doctrine_Core::getTable('Aluno')->findOrientacao($this->getUser()->getAttribute('id', null, 'usuario'));
        if(!$orientacao){
            $orientacao = new Orientacao();
            $orientacao->aluno_id = $this->getUser()->getAttribute('id', null, 'usuario');
            $orientacao->professor_id = $request->getParameter('professor_id');
            $orientacao->save();
            
            //recupera o numero de orientacoes que o professor tem
            $orientacoes = Doctrine_Core::getTable('Orientacao')->findOrientacoes($request->getParameter('professor_id'),null,1);
            if(count($orientacoes) > $this->getUser()->getAttribute('alunos_por_professor',0,'configuracao')){            
                $this->getUser()->setFlash('warning', 'O número de orientandos do professor excedeu o limite máximo. Sua solicitação será analisada pelo coordenador do curso.');
            } else {
                $this->getUser()->setFlash('success', 'Orientação solicitada com sucesso! Aguarde a decisão do professor.');
            }
        } else {
            if($orientacao->status == 0){
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já tem uma aguardando aceitação');
            } else {
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já está sendo orientado por um professor');
            }
            
        }

        $this->redirect('@orientador_list');
    }
    
    public function executeUpdateStatus(sfWebRequest $request)
    {
        $orientacao = Doctrine_Core::getTable('Orientacao')->findOrientacao(
            $this->getUser()->getAttribute('id',null,'usuario'), 
            $request->getParameter('aluno_id')
        );
        
        if($request->getParameter('acao') == 'aceitar'){
            $orientacao->status = 1;
            $this->getUser()->setFlash('success','Solicitação de orientação aceita com sucesso!');
        } else {
            $orientacao->status = 2;
            $this->getUser()->setFlash('success','Solicitação de orientação rejeitada com sucesso!');
        }
        
        $orientacao->save();
        $this->redirect('@orientandos_list');
    }
}   
