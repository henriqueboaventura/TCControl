<?php

/**
 * Orientacao filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrientacaoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'       => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1, 2 => 2))),
    ));

    $this->setValidators(array(
      'status'       => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1, 2 => 2))),
    ));

    $this->widgetSchema->setNameFormat('orientacao_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orientacao';
  }

  public function getFields()
  {
    return array(
      'aluno_id'     => 'Number',
      'professor_id' => 'Number',
      'status'       => 'Enum',
    );
  }
}
