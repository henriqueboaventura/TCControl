<?php

/**
 * professor actions.
 *
 * @package    TCCtrl
 * @subpackage professor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class professorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->professors = Doctrine::getTable('Professor')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ProfessorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ProfessorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfessorForm($professor);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
    $this->form = new ProfessorForm($professor);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($professor = Doctrine::getTable('Professor')->find(array($request->getParameter('id'))), sprintf('Object professor does not exist (%s).', $request->getParameter('id')));
    $professor->delete();

    $this->redirect('professor/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $professor = $form->save();

      $this->redirect('professor/edit?id='.$professor->getId());
    }
  }
}
