<?php

/**
 * Academico form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forgetPasswordForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'email'            => new sfWidgetFormInputText(),
            'matricula'        => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'email'            => new sfValidatorEmail(),
            'matricula'        => new sfValidatorString(array('max_length' => 100)),
        ));

        $this->widgetSchema->setNameFormat('forget_password[%s]');
    }
}
