<?php

/**
 * ArtigoAvaliacao form base class.
 *
 * @method ArtigoAvaliacao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtigoAvaliacaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'artigo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artigo'), 'add_empty' => true)),
      'aprovada'        => new sfWidgetFormInputCheckbox(),
      'parecer'         => new sfWidgetFormTextarea(),
      'versao_proposta' => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'artigo_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Artigo'), 'required' => false)),
      'aprovada'        => new sfValidatorBoolean(array('required' => false)),
      'parecer'         => new sfValidatorString(array('required' => false)),
      'versao_proposta' => new sfValidatorInteger(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('artigo_avaliacao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtigoAvaliacao';
  }

}
