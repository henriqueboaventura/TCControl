<?php

/**
 * TCC filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTCCFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etapa'    => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1))),
      'aluno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => true)),
      'semestre' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'etapa'    => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1))),
      'aluno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Aluno'), 'column' => 'id')),
      'semestre' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tcc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TCC';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'etapa'    => 'Enum',
      'aluno_id' => 'ForeignKey',
      'semestre' => 'Text',
    );
  }
}
