<?php

/**
 * PropostaVersao form base class.
 *
 * @method PropostaVersao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePropostaVersaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'aluno_id'           => new sfWidgetFormInputText(),
      'titulo'             => new sfWidgetFormInputText(),
      'descricao_problema' => new sfWidgetFormTextarea(),
      'descricao_solucao'  => new sfWidgetFormTextarea(),
      'objetivos'          => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'version'            => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'aluno_id'           => new sfValidatorInteger(),
      'titulo'             => new sfValidatorString(array('max_length' => 255)),
      'descricao_problema' => new sfValidatorString(),
      'descricao_solucao'  => new sfValidatorString(),
      'objetivos'          => new sfValidatorString(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'version'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proposta_versao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PropostaVersao';
  }

}
