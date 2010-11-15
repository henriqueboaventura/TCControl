<?php

/**
 * home actions.
 *
 * @package    TCCtrl
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        
        if(!$this->getUser()->hasCredential('administrador')){
            $this->setTemplate('dashboard');
            $this->aluno = ($this->getUser()->hasCredential('aluno')) ? $this->aluno = Doctrine::getTable('Aluno')->find($this->getUser()->getAttribute('id', null, 'usuario')) : false;
            $this->mensagens = Doctrine::getTable('Mensagem')->findMensagens($this->getUser()->getAttribute('id', null, 'usuario'), false);
            $this->arquivos = Doctrine::getTable('Arquivo')->findArquivos($this->getUser()->getAttribute('id', null, 'usuario'), false);
        }
    }
}
