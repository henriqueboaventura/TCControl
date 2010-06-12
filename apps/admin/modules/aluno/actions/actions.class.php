<?php

/**
 * aluno actions.
 *
 * @package    TCCtrl
 * @subpackage aluno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alunoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->alunos = Doctrine::getTable('Aluno')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AlunoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AlunoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
    $this->form = new AlunoForm($aluno);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
    $this->form = new AlunoForm($aluno);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
    $aluno->delete();

    $this->redirect('aluno/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $aluno = $form->save();

      $this->redirect('aluno/edit?id='.$aluno->getId());
    }
  }
}
