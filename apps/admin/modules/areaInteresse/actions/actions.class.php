<?php

/**
 * areaInteresse actions.
 *
 * @package    TCCtrl
 * @subpackage areaInteresse
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areaInteresseActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('AreaInteresse')->createQuery('a')->where('a.professor_id = ?', $this->getUser()->getAttribute('id',null,'usuario'));
        $this->pager = new sfDoctrinePager('AreaInteresse', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->areasInteresse = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new AreaInteresseForm();
        $this->form->setDefault('professor_id', $this->getUser()->getAttribute('id',null,'usuario'));
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AreaInteresseForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($area_interesse = Doctrine::getTable('AreaInteresse')->find(array($request->getParameter('id'))), sprintf('Object area_interesse does not exist (%s).', $request->getParameter('id')));
        $this->form = new AreaInteresseForm($area_interesse);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($area_interesse = Doctrine::getTable('AreaInteresse')->find(array($request->getParameter('id'))), sprintf('Object area_interesse does not exist (%s).', $request->getParameter('id')));
        $this->form = new AreaInteresseForm($area_interesse);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($area_interesse = Doctrine::getTable('AreaInteresse')->find(array($request->getParameter('id'))), sprintf('Object area_interesse does not exist (%s).', $request->getParameter('id')));
        $area_interesse->delete();

        $this->getUser()->setFlash('success', 'Área de Interesse excluída com sucesso!');
        $this->redirect('areaInteresse/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $area_interesse = $form->save();

            $this->getUser()->setFlash('success','Área de interesse ' . ($form->isNew() ? 'incluida' : 'alterada') . ' com sucesso!');
            $this->redirect('areaInteresse/edit?id='.$area_interesse->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }
}
