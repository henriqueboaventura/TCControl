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
      'id'             => new sfWidgetFormInputHidden(),
      'nome'           => new sfWidgetFormInputText(),
      'slug'           => new sfWidgetFormInputText(),
      'professor_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Professor')),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'           => new sfValidatorString(array('max_length' => 50)),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'professor_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Professor', 'required' => false)),
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

    if (isset($this->widgetSchema['professor_list']))
    {
      $this->setDefault('professor_list', $this->object->Professor->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveProfessorList($con);

    parent::doSave($con);
  }

  public function saveProfessorList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['professor_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Professor->getPrimaryKeys();
    $values = $this->getValue('professor_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Professor', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Professor', array_values($link));
    }
  }

}
