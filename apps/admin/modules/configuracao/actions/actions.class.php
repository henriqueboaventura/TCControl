<?php

/**
 * configuracao actions.
 *
 * @package    TCCtrl
 * @subpackage configuracao
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configuracaoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $configuracoes = Doctrine::getTable('Configuracao')->findAll();
        $configuracao = $configuracoes[0];

        $this->form = new ConfiguracaoForm($configuracao);

        if($request->isMethod(sfRequest::PUT)){
                $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if ($this->form->isValid()){
                $configuracao = $this->form->save();
                $this->getUser()->setFlash('success','Configuração alterada com sucesso!',false);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
            }
        }
    }
}
