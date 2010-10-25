<?php

/**
 * TCC form base class.
 *
 * @method TCC getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTCCForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'etapa'    => new sfWidgetFormChoice(array('choices' => array(0 => 0, 1 => 1))),
      'aluno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => true)),
      'semestre' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'etapa'    => new sfValidatorChoice(array('choices' => array(0 => 0, 1 => 1))),
      'aluno_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'required' => false)),
      'semestre' => new sfValidatorString(array('max_length' => 6)),
    ));

    $this->widgetSchema->setNameFormat('tcc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TCC';
  }

}
