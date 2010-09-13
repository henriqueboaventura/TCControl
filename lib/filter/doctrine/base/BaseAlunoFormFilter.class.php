<?php

/**
 * Aluno filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAlunoFormFilter extends AcademicoFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['orientador_list'] = new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Professor'));
    $this->validatorSchema['orientador_list'] = new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Professor', 'required' => false));

    $this->widgetSchema->setNameFormat('aluno_filters[%s]');
  }

  public function addOrientadorListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Orientacao Orientacao')
      ->andWhereIn('Orientacao.professor_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Aluno';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'orientador_list' => 'ManyKey',
    ));
  }
}
