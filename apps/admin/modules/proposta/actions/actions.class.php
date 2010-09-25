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

        $proposta = Doctrine_Core::getTable('Proposta')->findOneByAlunoId($aluno);
        
        if($proposta){
            $this->form = new PropostaForm($proposta);
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
        $query = Doctrine::getTable('Proposta')->findPropostaByProfessor($this->getUser()->getAttribute('id',null,'usuario'),$status,false);
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

        $this->etapa = array();
        foreach($this->proposta->Cronogramas as $cronograma){
            $this->etapa[$cronograma->etapa][] = $cronograma;
        }
    }

    public function executeUpdateStatus(sfWebRequest $request)
    {
        $proposta = Doctrine::getTable('Proposta')->find($request->getParameter('id'));

        if($request->getParameter('acao') == 'aceitar'){
            $proposta->status = 1;
            $this->getUser()->setFlash('success','Proposta aceita com sucesso!');
        } else {
            $proposta->status = 2;
            $this->getUser()->setFlash('success','Proposta rejeitada com sucesso!');
        }
        
        $proposta->save();
        $this->redirect('@proposta_list?filtro=aguardando');

    }
}
