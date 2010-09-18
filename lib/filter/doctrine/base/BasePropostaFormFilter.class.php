<?php

/**
 * Proposta filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePropostaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aluno_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => true)),
      'curso_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true)),
      'titulo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descricao_problema' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descricao_solucao'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'objetivos'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'             => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1, 2 => 2))),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'aluno_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Aluno'), 'column' => 'id')),
      'curso_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Curso'), 'column' => 'id')),
      'titulo'             => new sfValidatorPass(array('required' => false)),
      'descricao_problema' => new sfValidatorPass(array('required' => false)),
      'descricao_solucao'  => new sfValidatorPass(array('required' => false)),
      'objetivos'          => new sfValidatorPass(array('required' => false)),
      'status'             => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1, 2 => 2))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('proposta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proposta';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'aluno_id'           => 'ForeignKey',
      'curso_id'           => 'ForeignKey',
      'titulo'             => 'Text',
      'descricao_problema' => 'Text',
      'descricao_solucao'  => 'Text',
      'objetivos'          => 'Text',
      'status'             => 'Enum',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
