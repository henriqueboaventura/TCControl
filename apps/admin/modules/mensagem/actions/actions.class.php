<?php

/**
 * mensagem actions.
 *
 * @package    TCCtrl
 * @subpackage mensagem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mensagemActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Mensagem')->findMensagens($this->getUser()->getAttribute('id', null, 'usuario'), true);
        $this->pager = new sfDoctrinePager('Mensagem', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->mensagens = $this->pager->getResults();
    }
    
    public function executeNew(sfWebRequest $request)
    {
        $this->form = new MensagemForm();
    }
    
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        
        $this->form = new MensagemForm();
        
        $this->processForm($request, $this->form);
        
        $this->setTemplate('new');
    }
    
    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($mensagem = Doctrine::getTable('Mensagem')->find(array($request->getParameter('id'))), sprintf('Object mensagem does not exist (%s).', $request->getParameter('id')));
        $this->form = new MensagemForm($mensagem);
    }
    
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($mensagem = Doctrine::getTable('Mensagem')->find(array($request->getParameter('id'))), sprintf('Object mensagem does not exist (%s).', $request->getParameter('id')));
        $this->form = new MensagemForm($mensagem);
        
        $this->processForm($request, $this->form);
        
        $this->setTemplate('edit');
    }
    
    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($mensagem = Doctrine::getTable('Mensagem')->find(array($request->getParameter('id'))), sprintf('Object mensagem does not exist (%s).', $request->getParameter('id')));
        $mensagem->delete();
        
        $this->getUser()->setFlash('success', 'Mensagem excluída com sucesso!');
        
        $this->redirect('@mensagens');
    }
    
    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $mensagem = $form->save();
        
            $this->redirect('mensagem/edit?id='.$mensagem->getId());
        }
    }
}
