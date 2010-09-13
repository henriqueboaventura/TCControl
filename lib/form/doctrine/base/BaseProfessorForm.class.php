<?php

/**
 * Professor form base class.
 *
 * @method Professor getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfessorForm extends AcademicoForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['areas_afinidade_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade'));
    $this->validatorSchema['areas_afinidade_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade', 'required' => false));

    $this->widgetSchema   ['orientandos_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Aluno'));
    $this->validatorSchema['orientandos_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Aluno', 'required' => false));

    $this->widgetSchema->setNameFormat('professor[%s]');
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

    if (isset($this->widgetSchema['orientandos_list']))
    {
      $this->setDefault('orientandos_list', $this->object->Orientandos->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveAreasAfinidadeList($con);
    $this->saveOrientandosList($con);

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

  public function saveOrientandosList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['orientandos_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Orientandos->getPrimaryKeys();
    $values = $this->getValue('orientandos_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Orientandos', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Orientandos', array_values($link));
    }
  }

}
