<?php

/**
 * Cronograma filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCronogramaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proposta_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'add_empty' => true)),
      'etapa'        => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 1, 2 => 2))),
      'atividade'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'produto'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'data_entrega' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'detalhamento' => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'proposta_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proposta'), 'column' => 'id')),
      'etapa'        => new sfValidatorChoice(array('required' => false, 'choices' => array(1 => 1, 2 => 2))),
      'atividade'    => new sfValidatorPass(array('required' => false)),
      'produto'      => new sfValidatorPass(array('required' => false)),
      'data_entrega' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'detalhamento' => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cronograma_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cronograma';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'proposta_id'  => 'ForeignKey',
      'etapa'        => 'Enum',
      'atividade'    => 'Text',
      'produto'      => 'Text',
      'data_entrega' => 'Date',
      'detalhamento' => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
