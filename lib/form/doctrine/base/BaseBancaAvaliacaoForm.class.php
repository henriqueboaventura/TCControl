<?php

/**
 * BancaAvaliacao form base class.
 *
 * @method BancaAvaliacao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBancaAvaliacaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'banca_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Banca'), 'add_empty' => false)),
      'avaliacao_professor_1' => new sfWidgetFormChoice(array('choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_professor_2' => new sfWidgetFormChoice(array('choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'avaliacao_geral'       => new sfWidgetFormChoice(array('choices' => array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D'))),
      'parecer'               => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'banca_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Banca'))),
      'avaliacao_professor_1' => new sfValidatorChoice(array('choices' => array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D'))),
      'avaliacao_professor_2' => new sfValidatorChoice(array('choices' => array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D'))),
      'avaliacao_geral'       => new sfValidatorChoice(array('choices' => array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D'))),
      'parecer'               => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('banca_avaliacao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BancaAvaliacao';
  }

}
