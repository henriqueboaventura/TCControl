<?php

/**
 * AreaInteresse form base class.
 *
 * @method AreaInteresse getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAreaInteresseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'professor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'), 'add_empty' => false)),
      'nome'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'professor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'))),
      'nome'         => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('area_interesse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AreaInteresse';
  }

}
