<?php

/**
 * Professor form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfessorCoordenadorForm extends BaseProfessorForm
{
    public function configure()
    {
        parent::configure();

        $choices = array(
            false => 'Não',
            true => 'Sim'
        );
        
        unset (            
            $this['senha'],
            $this['areas_afinidade_list'],
            $this['orientandos_list']
        );

        //$this->widgetSchema['curso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true));

        //adiciona um checkbox caso ele for coordenador
        $this->widgetSchema['curso_id'] = new sfWidgetFormInputCheckbox(array(), array('value' => 1));

        $this->validatorSchema['curso_id'] = new sfValidatorInteger(
            array(
                'required' => false
            )
        );
        
        $this->widgetSchema->setLabel('curso_id','Coordenador');
    }
}
