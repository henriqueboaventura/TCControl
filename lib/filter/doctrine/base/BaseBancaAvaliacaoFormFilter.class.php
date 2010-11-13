<?php

/**
 * BancaAvaliacao filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBancaAvaliacaoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'banca_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banca'), 'add_empty' => true)),
      'avaliacao_professor_1' => new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_professor_2' => new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_professor_3' => new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_geral'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'parecer'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'banca_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Banca'), 'column' => 'id')),
      'avaliacao_professor_1' => new sfValidatorChoice(array('required' => false, 'choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_professor_2' => new sfValidatorChoice(array('required' => false, 'choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_professor_3' => new sfValidatorChoice(array('required' => false, 'choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_geral'       => new sfValidatorChoice(array('required' => false, 'choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'parecer'               => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('banca_avaliacao_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BancaAvaliacao';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'banca_id'              => 'ForeignKey',
      'avaliacao_professor_1' => 'Enum',
      'avaliacao_professor_2' => 'Enum',
      'avaliacao_professor_3' => 'Enum',
      'avaliacao_geral'       => 'Enum',
      'parecer'               => 'Text',
    );
  }
}
