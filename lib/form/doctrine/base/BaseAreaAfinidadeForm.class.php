<?php

/**
 * AreaAfinidade form base class.
 *
 * @method AreaAfinidade getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAreaAfinidadeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'nome'             => new sfWidgetFormInputText(),
      'slug'             => new sfWidgetFormInputText(),
      'professores_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Professor')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'             => new sfValidatorString(array('max_length' => 50)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'professores_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Professor', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'AreaAfinidade', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('area_afinidade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AreaAfinidade';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['professores_list']))
    {
      $this->setDefault('professores_list', $this->object->Professores->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveProfessoresList($con);

    parent::doSave($con);
  }

  public function saveProfessoresList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['professores_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Professores->getPrimaryKeys();
    $values = $this->getValue('professores_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Professores', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Professores', array_values($link));
    }
  }

}
