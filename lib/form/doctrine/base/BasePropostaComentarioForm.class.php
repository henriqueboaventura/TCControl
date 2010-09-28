<?php

/**
 * PropostaComentario form base class.
 *
 * @method PropostaComentario getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePropostaComentarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'proposta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'add_empty' => true)),
      'conteudo'    => new sfWidgetFormTextarea(),
      'local'       => new sfWidgetFormChoice(array('choices' => array('titulo' => 'titulo', 'descricao_problema' => 'descricao_problema', 'descricao_solucao' => 'descricao_solucao', 'objetivos' => 'objetivos'))),
      'lido'        => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'proposta_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'required' => false)),
      'conteudo'    => new sfValidatorString(),
      'local'       => new sfValidatorChoice(array('choices' => array(0 => 'titulo', 1 => 'descricao_problema', 2 => 'descricao_solucao', 3 => 'objetivos'), 'required' => false)),
      'lido'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('proposta_comentario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PropostaComentario';
  }

}
