<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nome'             => new sfWidgetFormInputText(),
      'email'            => new sfWidgetFormInputText(),
      'senha'            => new sfWidgetFormInputText(),
      'type'             => new sfWidgetFormInputText(),
      'matricula'        => new sfWidgetFormInputText(),
      'endereco'         => new sfWidgetFormInputText(),
      'fone_residencial' => new sfWidgetFormInputText(),
      'fone_celular'     => new sfWidgetFormInputText(),
      'coordenador'      => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'             => new sfValidatorString(array('max_length' => 50)),
      'email'            => new sfValidatorString(array('max_length' => 100)),
      'senha'            => new sfValidatorString(array('max_length' => 128)),
      'type'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'matricula'        => new sfValidatorString(array('max_length' => 20)),
      'endereco'         => new sfValidatorString(array('max_length' => 200)),
      'fone_residencial' => new sfValidatorString(array('max_length' => 20)),
      'fone_celular'     => new sfValidatorString(array('max_length' => 20)),
      'coordenador'      => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Usuario', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
