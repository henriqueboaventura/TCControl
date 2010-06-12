<?php

/**
 * areaAfinidade actions.
 *
 * @package    TCCtrl
 * @subpackage areaAfinidade
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areaAfinidadeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->area_afinidades = Doctrine::getTable('AreaAfinidade')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AreaAfinidadeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AreaAfinidadeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaAfinidadeForm($area_afinidade);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
    $this->form = new AreaAfinidadeForm($area_afinidade);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
    $area_afinidade->delete();

    $this->redirect('areaAfinidade/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $area_afinidade = $form->save();

      $this->redirect('areaAfinidade/edit?id='.$area_afinidade->getId());
    }
  }
}
