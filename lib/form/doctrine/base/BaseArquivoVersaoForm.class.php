<?php

/**
 * ArquivoVersao form base class.
 *
 * @method ArquivoVersao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArquivoVersaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'remetente_id'    => new sfWidgetFormInputText(),
      'destinatario_id' => new sfWidgetFormInputText(),
      'nome'            => new sfWidgetFormInputText(),
      'tipo'            => new sfWidgetFormChoice(array('choices' => array('modelagem' => 'modelagem', 'documento' => 'documento', 'imagem' => 'imagem', 'outro' => 'outro'))),
      'path'            => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'version'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'remetente_id'    => new sfValidatorInteger(array('required' => false)),
      'destinatario_id' => new sfValidatorInteger(array('required' => false)),
      'nome'            => new sfValidatorString(array('max_length' => 100)),
      'tipo'            => new sfValidatorChoice(array('choices' => array(0 => 'modelagem', 1 => 'documento', 2 => 'imagem', 3 => 'outro'))),
      'path'            => new sfValidatorString(array('max_length' => 100)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'version'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('arquivo_versao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArquivoVersao';
  }

}
