<?php
class PasswordForm extends sfForm
{
    public function setup()
    {
        $this->setWidgets(array(
            'id'              => new sfWidgetFormInputHidden(),
            'senha_atual'     => new sfWidgetFormInputPassword(),
            'nova_senha'      => new sfWidgetFormInputPassword(),
            'confirmar_senha' => new sfWidgetFormInputPassword(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorInteger(),
            'senha_atual' => new sfValidatorString(array('required' => true)),
            'nova_senha' => new sfValidatorString(array('required' => true, 'min_length' => 8),array('min_length' => 'A senha deve ter no mínimo 8 caracteres')),
            'confirmar_senha' => new sfValidatorString(),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array('callback' => array($this, 'checkPassword')))
        );

        $this->widgetSchema->setNameFormat('password[%s]');
    }

    public function checkPassword($validator, $values)
    {
        $usuario = Doctrine::getTable('Usuario')->find($values['id']);
        if($values['senha_atual'] != '' AND $usuario->senha != sha1($values['senha_atual'])){
            $error = new sfValidatorError($validator, 'Senha atual inválida',array('column' => 'senha_atual'));
            throw new sfValidatorErrorSchema($validator, array('senha_atual' => $error));
        }

        if($values['nova_senha'] != '' AND $values['nova_senha'] != $values['confirmar_senha']){
            $error = new sfValidatorError($validator, 'Senhas não conferem',array('column' => 'nova_senha'));
            throw new sfValidatorErrorSchema($validator, array('nova_senha' => $error));
        }
    }
}
