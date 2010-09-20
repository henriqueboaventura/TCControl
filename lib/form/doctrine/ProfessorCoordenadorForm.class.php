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

        $this->setWidget('coordenador', new sfWidgetFormChoice(array(
            'choices'     => $choices,
        )));
    }
}
