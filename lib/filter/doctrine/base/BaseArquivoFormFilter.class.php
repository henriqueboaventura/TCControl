<?php

/**
 * Arquivo filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseArquivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'remetente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Remetente'), 'add_empty' => true)),
      'destinatario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'add_empty' => true)),
      'nome'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'modelagem' => 'modelagem', 'documento' => 'documento', 'imagem' => 'imagem', 'outro' => 'outro'))),
      'path'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'version'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'remetente_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Remetente'), 'column' => 'id')),
      'destinatario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Destinatario'), 'column' => 'id')),
      'nome'            => new sfValidatorPass(array('required' => false)),
      'tipo'            => new sfValidatorChoice(array('required' => false, 'choices' => array('modelagem' => 'modelagem', 'documento' => 'documento', 'imagem' => 'imagem', 'outro' => 'outro'))),
      'path'            => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('arquivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Arquivo';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'remetente_id'    => 'ForeignKey',
      'destinatario_id' => 'ForeignKey',
      'nome'            => 'Text',
      'tipo'            => 'Enum',
      'path'            => 'Text',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'version'         => 'Number',
    );
  }
}
