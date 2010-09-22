<?php

/**
 * Proposta form base class.
 *
 * @method Proposta getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePropostaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'aluno_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => false)),
      'titulo'             => new sfWidgetFormInputText(),
      'descricao_problema' => new sfWidgetFormTextarea(),
      'descricao_solucao'  => new sfWidgetFormTextarea(),
      'objetivos'          => new sfWidgetFormTextarea(),
      'status'             => new sfWidgetFormChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2))),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'aluno_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'))),
      'titulo'             => new sfValidatorString(array('max_length' => 255)),
      'descricao_problema' => new sfValidatorString(),
      'descricao_solucao'  => new sfValidatorString(),
      'objetivos'          => new sfValidatorString(),
      'status'             => new sfValidatorChoice(array('choices' => array(0 => 0, 1 => 1, 2 => 2), 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('proposta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proposta';
  }

}
