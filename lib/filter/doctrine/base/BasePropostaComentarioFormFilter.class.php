<?php

/**
 * PropostaComentario filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePropostaComentarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'proposta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'add_empty' => true)),
      'conteudo'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'local'       => new sfWidgetFormChoice(array('choices' => array('' => '', 'titulo' => 'titulo', 'descricao_problema' => 'descricao_problema', 'descricao_solucao' => 'descricao_solucao', 'objetivos' => 'objetivos'))),
      'lido'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'proposta_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Proposta'), 'column' => 'id')),
      'conteudo'    => new sfValidatorPass(array('required' => false)),
      'local'       => new sfValidatorChoice(array('required' => false, 'choices' => array('titulo' => 'titulo', 'descricao_problema' => 'descricao_problema', 'descricao_solucao' => 'descricao_solucao', 'objetivos' => 'objetivos'))),
      'lido'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('proposta_comentario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PropostaComentario';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'proposta_id' => 'ForeignKey',
      'conteudo'    => 'Text',
      'local'       => 'Enum',
      'lido'        => 'Boolean',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
