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

    public function executeView(sfWebRequest $request)
    {
        $this->forward404Unless($this->mensagem = Doctrine::getTable('Mensagem')->find(array($request->getParameter('id'))), sprintf('Object mensagem does not exist (%s).', $request->getParameter('id')));
        $this->mensagem->lido = true;
        $this->mensagem->save();
    }

    public function executeReply(sfWebRequest $request)
    {
        $this->forward404Unless($this->mensagem = Doctrine::getTable('Mensagem')->find(array($request->getParameter('id'))), sprintf('Object mensagem does not exist (%s).', $request->getParameter('id')));

        

        $this->form = new MensagemReplyForm();
        $this->form->setDefaults(array(
            'original_id' => $this->mensagem->id,
            'remetente_id' => $this->getUser()->getAttribute('id', null, 'usuario'),
            'destinatario_id' => $this->mensagem->Remetente->id,
            'assunto' => $this->mensagem->assunto,
            'conteudo' => $this->mensagem->conteudo = '<br />-----------------------------------------------------------<br/ >' . $this->mensagem->conteudo
        ));
        if($request->isMethod(sfRequest::POST)){
            $this->processForm($request, $this->form);
        }
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = ($this->getUser()->hasCredential('aluno')) ? new MensagemAlunoForm() : new MensagemProfessorForm();
        $this->form->setDefault('remetente_id', $this->getUser()->getAttribute('id', null, 'usuario'));
    }
    
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        
        $this->form = ($this->getUser()->hasCredential('aluno')) ? new MensagemAlunoForm() : new MensagemProfessorForm();
        
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
        $this->form = ($this->getUser()->hasCredential('aluno')) ? new MensagemAlunoForm($mensagem) : new MensagemProfessorForm($mensagem);
        
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

            $this->getUser()->setFlash('success','Mensagem enviada com sucesso!');
            $this->redirect('@mensagens');
        }
    }
}
