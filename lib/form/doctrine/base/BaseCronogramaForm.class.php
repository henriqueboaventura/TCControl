<?php

/**
 * Cronograma form base class.
 *
 * @method Cronograma getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCronogramaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'proposta_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'add_empty' => true)),
      'etapa'        => new sfWidgetFormChoice(array('choices' => array(1 => 1, 2 => 2))),
      'atividade'    => new sfWidgetFormInputText(),
      'produto'      => new sfWidgetFormInputText(),
      'data_entrega' => new sfWidgetFormDate(),
      'detalhamento' => new sfWidgetFormTextarea(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'proposta_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'required' => false)),
      'etapa'        => new sfValidatorChoice(array('choices' => array(0 => 1, 1 => 2), 'required' => false)),
      'atividade'    => new sfValidatorString(array('max_length' => 255)),
      'produto'      => new sfValidatorString(array('max_length' => 100)),
      'data_entrega' => new sfValidatorDate(),
      'detalhamento' => new sfValidatorString(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cronograma[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cronograma';
  }

}
