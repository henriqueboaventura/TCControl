<?php

/**
 * Mensagem form base class.
 *
 * @method Mensagem getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMensagemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'remetente_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Remetente'), 'add_empty' => true)),
      'destinatario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'add_empty' => true)),
      'original_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Original'), 'add_empty' => true)),
      'assunto'         => new sfWidgetFormInputText(),
      'conteudo'        => new sfWidgetFormTextarea(),
      'lido'            => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'remetente_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Remetente'), 'required' => false)),
      'destinatario_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Destinatario'), 'required' => false)),
      'original_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Original'), 'required' => false)),
      'assunto'         => new sfValidatorString(array('max_length' => 150)),
      'conteudo'        => new sfValidatorString(),
      'lido'            => new sfValidatorBoolean(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('mensagem[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mensagem';
  }

}
