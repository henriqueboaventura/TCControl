<?php

/**
 * Configuracao form base class.
 *
 * @method Configuracao getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseConfiguracaoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'instituicao'          => new sfWidgetFormInputText(),
      'email'                => new sfWidgetFormInputText(),
      'telefone'             => new sfWidgetFormInputText(),
      'alunos_por_professor' => new sfWidgetFormInputText(),
      'url'                  => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'instituicao'          => new sfValidatorString(array('max_length' => 100)),
      'email'                => new sfValidatorString(array('max_length' => 100)),
      'telefone'             => new sfValidatorString(array('max_length' => 50)),
      'alunos_por_professor' => new sfValidatorInteger(),
      'url'                  => new sfValidatorString(array('max_length' => 100)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('configuracao[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Configuracao';
  }

}
