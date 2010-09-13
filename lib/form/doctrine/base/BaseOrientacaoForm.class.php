<?php

/**
 * Orientacao form base class.
 *
 * @method Orientacao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrientacaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aluno_id'     => new sfWidgetFormInputHidden(),
      'professor_id' => new sfWidgetFormInputHidden(),
      'aceito'       => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'aluno_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('aluno_id')), 'empty_value' => $this->getObject()->get('aluno_id'), 'required' => false)),
      'professor_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('professor_id')), 'empty_value' => $this->getObject()->get('professor_id'), 'required' => false)),
      'aceito'       => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orientacao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orientacao';
  }

}
