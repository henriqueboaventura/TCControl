<?php

/**
 * Banca form base class.
 *
 * @method Banca getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBancaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'aluno_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'), 'add_empty' => false)),
      'professor_id_1' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador1'), 'add_empty' => false)),
      'professor_id_2' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador2'), 'add_empty' => false)),
      'professor_id_3' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador3'), 'add_empty' => false)),
      'data_banca'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'aluno_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Aluno'))),
      'professor_id_1' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador1'))),
      'professor_id_2' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador2'))),
      'professor_id_3' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador3'))),
      'data_banca'     => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('banca[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banca';
  }

}
