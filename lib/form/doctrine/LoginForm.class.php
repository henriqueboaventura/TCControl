<?php

/**
 * Usuario form.
 *
 * @package    form
 * @subpackage Usuario
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class LoginForm extends sfForm
{
    public function configure()
    {
        parent::configure();

        $this->setWidgets(array(
            'email'    => new sfWidgetFormInput(),
            'senha'      => new sfWidgetFormInputPassword(),
        ));

        $this->widgetSchema->setLabels(array(
            'email' => 'E-mail',
        ));

        $this->validatorSchema['email'] = new sfValidatorString(array('required'=>true),array('required'=>'Requirido'));
        $this->validatorSchema['senha'] = new sfValidatorString(array('required'=>true),array('required'=>'Requirido'));

        $this->widgetSchema->setNameFormat('login[%s]');
    }



}
