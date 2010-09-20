<?php

/**
 * AreaAfinidade filter form base class.
 *
 * @package    TCCtrl
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAreaAfinidadeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nome'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'slug'           => new sfWidgetFormFilterInput(),
      'professor_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Professor')),
    ));

    $this->setValidators(array(
      'nome'           => new sfValidatorPass(array('required' => false)),
      'slug'           => new sfValidatorPass(array('required' => false)),
      'professor_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Professor', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('area_afinidade_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addProfessorListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('ProfessorAreaAfinidade.professor_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'AreaAfinidade';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'nome'           => 'Text',
      'slug'           => 'Text',
      'professor_list' => 'ManyKey',
    );
  }
}
