<?php

/**
 * Banca filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBancaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aluno_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => true)),
      'professor_id_1' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador1'), 'add_empty' => true)),
      'professor_id_2' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador2'), 'add_empty' => true)),
      'professor_id_3' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador3'), 'add_empty' => true)),
      'data_banca'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'aluno_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Aluno'), 'column' => 'id')),
      'professor_id_1' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avaliador1'), 'column' => 'id')),
      'professor_id_2' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avaliador2'), 'column' => 'id')),
      'professor_id_3' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avaliador3'), 'column' => 'id')),
      'data_banca'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('banca_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banca';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'aluno_id'       => 'ForeignKey',
      'professor_id_1' => 'ForeignKey',
      'professor_id_2' => 'ForeignKey',
      'professor_id_3' => 'ForeignKey',
      'data_banca'     => 'Date',
    );
  }
}
