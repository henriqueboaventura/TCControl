<?php

/**
 * Aluno form base class.
 *
 * @method Aluno getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAlunoForm extends AcademicoForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['orientador_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Professor'));
    $this->validatorSchema['orientador_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Professor', 'required' => false));

    $this->widgetSchema->setNameFormat('aluno[%s]');
  }

  public function getModelName()
  {
    return 'Aluno';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['orientador_list']))
    {
      $this->setDefault('orientador_list', $this->object->Orientador->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveOrientadorList($con);

    parent::doSave($con);
  }

  public function saveOrientadorList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['orientador_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Orientador->getPrimaryKeys();
    $values = $this->getValue('orientador_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Orientador', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Orientador', array_values($link));
    }
  }

}
