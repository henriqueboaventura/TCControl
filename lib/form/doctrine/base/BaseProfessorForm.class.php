<?php

/**
 * Professor form base class.
 *
 * @method Professor getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfessorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'nome'                 => new sfWidgetFormInputText(),
      'email'                => new sfWidgetFormInputText(),
      'senha'                => new sfWidgetFormInputText(),
      'matricula'            => new sfWidgetFormInputText(),
      'endereco'             => new sfWidgetFormInputText(),
      'fone_residencial'     => new sfWidgetFormInputText(),
      'fone_celular'         => new sfWidgetFormInputText(),
      'coordenador'          => new sfWidgetFormInputCheckbox(),
      'areas_afinidade_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'                 => new sfValidatorString(array('max_length' => 50)),
      'email'                => new sfValidatorString(array('max_length' => 100)),
      'senha'                => new sfValidatorString(array('max_length' => 128)),
      'matricula'            => new sfValidatorString(array('max_length' => 20)),
      'endereco'             => new sfValidatorString(array('max_length' => 200)),
      'fone_residencial'     => new sfValidatorString(array('max_length' => 20)),
      'fone_celular'         => new sfValidatorString(array('max_length' => 20)),
      'coordenador'          => new sfValidatorBoolean(array('required' => false)),
      'areas_afinidade_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Professor', 'column' => array('email'))),
        new sfValidatorDoctrineUnique(array('model' => 'Professor', 'column' => array('matricula'))),
      ))
    );

    $this->widgetSchema->setNameFormat('professor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Professor';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['areas_afinidade_list']))
    {
      $this->setDefault('areas_afinidade_list', $this->object->AreasAfinidade->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveAreasAfinidadeList($con);

    parent::doSave($con);
  }

  public function saveAreasAfinidadeList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['areas_afinidade_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->AreasAfinidade->getPrimaryKeys();
    $values = $this->getValue('areas_afinidade_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('AreasAfinidade', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('AreasAfinidade', array_values($link));
    }
  }

}
