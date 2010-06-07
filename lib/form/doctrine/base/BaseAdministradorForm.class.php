<?php

/**
 * Administrador form base class.
 *
 * @method Administrador getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdministradorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(),
      'nome'  => new sfWidgetFormInputText(),
      'email' => new sfWidgetFormInputText(),
      'senha' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'  => new sfValidatorString(array('max_length' => 50)),
      'email' => new sfValidatorString(array('max_length' => 100)),
      'senha' => new sfValidatorString(array('max_length' => 128)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Administrador', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('administrador[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Administrador';
  }

}
