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
    $this->area_interesses = Doctrine::getTable('AreaInteresse')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreaInteresseForm();
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
    $request->checkCSRFProtection();

    $this->forward404Unless($area_interesse = Doctrine::getTable('AreaInteresse')->find(array($request->getParameter('id'))), sprintf('Object area_interesse does not exist (%s).', $request->getParameter('id')));
    $area_interesse->delete();

    $this->redirect('areaInteresse/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $area_interesse = $form->save();

      $this->redirect('areaInteresse/edit?id='.$area_interesse->getId());
    }
  }
}
