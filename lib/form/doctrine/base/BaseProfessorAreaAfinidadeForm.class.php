<?php

/**
 * ProfessorAreaAfinidade form base class.
 *
 * @method ProfessorAreaAfinidade getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfessorAreaAfinidadeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'professor_id'      => new sfWidgetFormInputHidden(),
      'area_afinidade_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'professor_id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('professor_id')), 'empty_value' => $this->getObject()->get('professor_id'), 'required' => false)),
      'area_afinidade_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('area_afinidade_id')), 'empty_value' => $this->getObject()->get('area_afinidade_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('professor_area_afinidade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfessorAreaAfinidade';
  }

}
