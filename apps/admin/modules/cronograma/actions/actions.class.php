<?php

/**
 * cronograma actions.
 *
 * @package    TCCtrl
 * @subpackage cronograma
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cronogramaActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->cronogramas = Doctrine::getTable('Cronograma')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CronogramaForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CronogramaForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
    $this->form = new CronogramaForm($cronograma);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
    $this->form = new CronogramaForm($cronograma);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
    $cronograma->delete();

    $this->redirect('cronograma/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cronograma = $form->save();

      $this->redirect('cronograma/edit?id='.$cronograma->getId());
    }
  }
}
