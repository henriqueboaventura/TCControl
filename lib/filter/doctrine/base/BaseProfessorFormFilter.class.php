<?php

/**
 * Professor filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfessorFormFilter extends AcademicoFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['areas_afinidade_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade'));
    $this->validatorSchema['areas_afinidade_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'AreaAfinidade', 'required' => false));

    $this->widgetSchema->setNameFormat('professor_filters[%s]');
  }

  public function addAreasAfinidadeListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.ProfessorAreaAfinidade ProfessorAreaAfinidade')
      ->andWhereIn('ProfessorAreaAfinidade.area_afinidade_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Professor';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'areas_afinidade_list' => 'ManyKey',
    ));
  }
}
