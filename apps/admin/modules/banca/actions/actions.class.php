<?php

/**
 * banca actions.
 *
 * @package    TCCtrl
 * @subpackage banca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bancaActions extends sfActions {

    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Banca')->createQuery('a');
        $this->pager = new sfDoctrinePager('Banca', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->bancas = $this->pager->getResults();

        $this->avaliacao = false;
    }

    public function executeListAvaliacao(sfWebRequest $request)
    {
        $this->setTemplate('index');
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine::getTable('BancaAvaliacao')->listAguardandoAvaliacao(false);
        $this->pager = new sfDoctrinePager('Banca', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->bancas = $this->pager->getResults();

        $this->avaliacao = true;
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new BancaForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new BancaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($this->banca = Doctrine::getTable('Banca')->find(array($request->getParameter('id'))), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
        $this->form = new BancaForm($this->banca);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($this->banca = Doctrine::getTable('Banca')->find(array($request->getParameter('id'))), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
        $this->form = new BancaForm($this->banca);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($banca = Doctrine::getTable('Banca')->find(array($request->getParameter('id'))), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
        $banca->delete();

        $this->getUser()->setFlash('success', 'Banca excluída com sucesso!');
        $this->redirect('banca/index');
    }

    public function executeAvaliar(sfWebRequest $request)
    {
        $this->forward404Unless($this->banca = Doctrine::getTable('Banca')->find(array($request->getParameter('id'))), sprintf('Object banca does not exist (%s).', $request->getParameter('id')));
        $this->form = new BancaAvaliacaoForm();
        $this->form->setDefault('banca_id', $this->banca->id);
        $this->form->setLabelProfessor(1, $this->banca->Avaliador1->nome);
        $this->form->setLabelProfessor(2, $this->banca->Avaliador2->nome);

        if($request->isMethod(sfRequest::POST)){
            $this->form->bind($request->getParameter($this->form->getName()));
            if($this->form->isValid()){
                $this->form->save();
                $this->getUser()->setFlash('success','Banca avaliada com sucesso!');
                $this->redirect('@bancas_avaliacao');
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
            }
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $banca = $form->save();
            
            $this->getUser()->setFlash('success','Banca ' . ($form->isNew() ? 'agendada' : 'alterada') . ' com sucesso!');
            $this->redirect('banca/edit?id='.$banca->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }

}
