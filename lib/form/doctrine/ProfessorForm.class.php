<?php

/**
 * Professor form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfessorForm extends BaseProfessorForm
{
    public function configure()
    {
        parent::configure();

        unset (
            $this['curso_id'],
            $this['senha'],
            $this['areas_afinidade_list'],
            $this['orientandos_list'],
            $this['curso_id']
        );
        
    }
}
