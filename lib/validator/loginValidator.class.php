<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of swLoginValidatorclass
 *
 * @author hboaventura
 */
class loginValidator extends sfValidatorBase
{
    public function configure($options = array(), $messages = array())
    {
        $this->addOption('user_field'        , 'usuario');
        $this->addOption('pass_field'        , 'senha');
        $this->addOption('throw_global_error', true);

        $this->setMessage('invalid', 'O usuario/senha inválido.');
    }

    protected function doClean($values)
    {
        $user = isset($values[$this->getOption('user_field')]  ) ? $values[$this->getOption('user_field')]   : '';
        $pass = isset($values[$this->getOption('pass_field')]    ) ? $values[$this->getOption('pass_field')]     : '';

        if ($user != '' AND $pass != '') {
            $user = Doctrine::getTable('Usuario')->createQuery('u')
                    ->where('u.email = ?', $user)
                    ->andWhere('u.senha = ?', sha1($pass))
                    ->fetchArray();

            if (count($user) != 1) {
                throw new sfValidatorError($this, 'invalid');
            } else {
                return true;
            }

            if ($this->getOption('throw_global_error')){
                throw new sfValidatorError($this, 'invalid');
            }
        }
    }
}

