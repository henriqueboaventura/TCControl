<?php

/**
 * login actions.
 *
 * @package    TCCtrl
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{
    public function executeSignin($request) {
        $user = $this->getUser();
        if ($user->isAuthenticated()) {
            return $this->redirect('@home');
        }

        $this->form = new LoginForm();

        $this->preSignin($request);

        if ($request->isMethod('post')) {
            
            try{
                $this->form->bind($request->getParameter('login'));
                if(!$this->form->isValid()){
                    throw new Exception('Preencha todos os campos');
                }
                $usuario = Doctrine::getTable('Usuario')->createQuery('u')
                         ->where('u.email = ?', $this->form->getValue('email'))
                         ->andWhere('u.senha = ?', sha1($this->form->getValue('senha')))
                         ->fetchOne();

                if($usuario == false){
                    throw new Exception('Usuário/senha inválido');
                }

                $this->getUser()->signin($usuario, false);

                $this->postSignin($request);

                // always redirect to a URL set in app.yml
                // or to the referer
                // or to the homepage
                $signinUrl = sfConfig::get('app_doAuth_signin_url', $user->getReferer($request->getReferer()));

                return $this->redirect('' != $signinUrl ? $signinUrl : '@home');
            } catch (Exception $e){
                $this->getUser()->setFlash('error',$e->getMessage());
            }
        } else {
            // if we have been forwarded, then the referer is the current URL
            // if not, this is the referer of the current request
            $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());

            $module = sfConfig::get('sf_login_module');
            if ($this->getModuleName() != $module) {
                $this->getLogger()->warning('User is accessing signin action which is currently not configured in settings.yml. Please secure this action or update configuration');
            }
        }
    }


    public function executeSignout($request) {
        $this->getUser()->signOut();

        $signoutUrl = sfConfig::get('app_doAuth_signout_url', $request->getReferer());

        $this->redirect('' != $signoutUrl ? $signoutUrl : '@homepage');
    }

    public function executeForgetPassword(sfWebRequest $request)
    {
        $this->form = new forgetPasswordForm();        
        if ($request->isMethod('post')) {
            try{
                $this->form->bind($request->getParameter('forget_password'));
                if(!$this->form->isValid()){
                    throw new Exception('Preencha todos os campos');
                }
                $usuario = Doctrine::getTable('Usuario')->createQuery('u')
                         ->where('u.email = ?', $this->form->getValue('email'))
                         ->andWhere('u.matricula = ?', $this->form->getValue('matricula'))
                         ->fetchOne();

                if($usuario == false){
                    throw new Exception('E-mail/Matricula inválido');
                }

                $this->sendPassword($usuario);
                $request->setParameter('forget_password', null);
                $this->setTemplate('sent');
            } catch (Exception $e){
                $this->getUser()->setFlash('error',$e->getMessage());
            }
        }
    }

    private function sendPassword($usuario)
    {
        $senha = Util::generatePassword();
        $usuario->senha = $senha;
        $usuario->save();

        $mail = new NovaSenhaMail($usuario->email, array('senha' => $senha));
        $mail->send();
    }
    
    protected function preSignin(sfWebRequest $request) {}
    protected function postSignin(sfWebRequest $request) {}

    protected function preRegister(sfWebRequest $request) {}
    protected function postRegister(sfWebRequest $request) {}

    protected function preActivate(sfWebRequest $request) {}
    protected function postActivate(sfWebRequest $request) {}

}