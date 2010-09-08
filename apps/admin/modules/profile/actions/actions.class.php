<?php

/**
 * profile actions.
 *
 * @package    TCCtrl
 * @subpackage profile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileActions extends sfActions
{
    public function executeSenha(sfWebRequest $request)
    {
        $this->form = new PasswordForm(array('id' => $this->getUser()->getAttribute('id',null,'usuario')));
        if($request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()),
                $request->getFiles($this->form->getName())
            );

            if($this->form->isValid()){
                $values = $request->getPostParameter($this->form->getName());
                $usuario = Doctrine::getTable('Usuario')->find($values['id']);
                $usuario->senha = $values['nova_senha'];
                $usuario->save();
                $this->getUser()->setFlash('success','Senha alterada com sucesso!');
                $this->redirect('profile/senha');
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!');
            }
            
        }
    }
}
