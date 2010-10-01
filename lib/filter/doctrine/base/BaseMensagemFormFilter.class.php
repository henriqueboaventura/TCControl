<?php

/**
 * Mensagem filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMensagemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'remetente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Remetente'), 'add_empty' => true)),
      'destinatario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'add_empty' => true)),
      'original_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Original'), 'add_empty' => true)),
      'assunto'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'conteudo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lido'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'remetente_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Remetente'), 'column' => 'id')),
      'destinatario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Destinatario'), 'column' => 'id')),
      'original_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Original'), 'column' => 'id')),
      'assunto'         => new sfValidatorPass(array('required' => false)),
      'conteudo'        => new sfValidatorPass(array('required' => false)),
      'lido'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('mensagem_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensagem';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'remetente_id'    => 'ForeignKey',
      'destinatario_id' => 'ForeignKey',
      'original_id'     => 'ForeignKey',
      'assunto'         => 'Text',
      'conteudo'        => 'Text',
      'lido'            => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
