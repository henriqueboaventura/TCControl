<?php

/**
 * Usuario filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'senha'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'             => new sfWidgetFormFilterInput(),
      'matricula'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'endereco'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fone_residencial' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fone_celular'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'curso_id'         => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nome'             => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'senha'            => new sfValidatorPass(array('required' => false)),
      'type'             => new sfValidatorPass(array('required' => false)),
      'matricula'        => new sfValidatorPass(array('required' => false)),
      'endereco'         => new sfValidatorPass(array('required' => false)),
      'fone_residencial' => new sfValidatorPass(array('required' => false)),
      'fone_celular'     => new sfValidatorPass(array('required' => false)),
      'curso_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'nome'             => 'Text',
      'email'            => 'Text',
      'senha'            => 'Text',
      'type'             => 'Text',
      'matricula'        => 'Text',
      'endereco'         => 'Text',
      'fone_residencial' => 'Text',
      'fone_celular'     => 'Text',
      'curso_id'         => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
