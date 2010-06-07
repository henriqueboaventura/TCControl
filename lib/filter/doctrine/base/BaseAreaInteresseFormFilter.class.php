<?php

/**
 * AreaInteresse filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAreaInteresseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'professor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'), 'add_empty' => true)),
      'nome'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'professor_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Professor'), 'column' => 'id')),
      'nome'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('area_interesse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AreaInteresse';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'professor_id' => 'ForeignKey',
      'nome'         => 'Text',
    );
  }
}
