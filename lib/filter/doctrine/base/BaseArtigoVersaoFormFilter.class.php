<?php

/**
 * ArtigoVersao filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArtigoVersaoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'aluno_id'   => new sfWidgetFormFilterInput(),
      'conteudo'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'     => new sfWidgetFormChoice(array('choices' => array('' => '', 0 => 0, 1 => 1, 2 => 2))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'aluno_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'conteudo'   => new sfValidatorPass(array('required' => false)),
      'status'     => new sfValidatorChoice(array('required' => false, 'choices' => array(0 => 0, 1 => 1, 2 => 2))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('artigo_versao_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtigoVersao';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'aluno_id'   => 'Number',
      'conteudo'   => 'Text',
      'status'     => 'Enum',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'version'    => 'Number',
    );
  }
}
