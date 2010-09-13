<?php

/**
 * Usuario form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm
{
    public function configure()
    {
        unset(
           $this['created_at'],
           $this['updated_at']
        );

        $this->widgetSchema['type'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['senha'] = new sfWidgetFormInputPassword();

        $this->widgetSchema->setLabels(array(
            'email'    => 'E-mail',
            'endereco' => 'Endereço',
            'fone_residencial' => 'Telefone (Residencial)',
            'fone_celular' => 'Telefone (Celular)'
        ));

        $this->validatorSchema['email'] = new sfValidatorEmail(
            array(
                'max_length' => 100
            )
        );
        $this->validatorSchema['senha'] = new sfValidatorString(
            array(
                'max_length' => 128,
                'min_length' => 8
            ),
            array(
                'min_length' => 'A senha deve ter no mínimo 8 caracteres'
            )
        );
    }
}
