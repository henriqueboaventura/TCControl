<?php

/**
 * ArtigoComentario form base class.
 *
 * @method ArtigoComentario getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseArtigoComentarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'artigo_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Artigo'), 'add_empty' => true)),
      'conteudo'   => new sfWidgetFormTextarea(),
      'lido'       => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'artigo_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Artigo'), 'required' => false)),
      'conteudo'   => new sfValidatorString(),
      'lido'       => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('artigo_comentario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ArtigoComentario';
  }

}
