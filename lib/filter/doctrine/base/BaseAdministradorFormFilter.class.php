<?php

/**
 * Administrador filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdministradorFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'senha' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nome'  => new sfValidatorPass(array('required' => false)),
      'email' => new sfValidatorPass(array('required' => false)),
      'senha' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('administrador_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Administrador';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'nome'  => 'Text',
      'email' => 'Text',
      'senha' => 'Text',
    );
  }
}
