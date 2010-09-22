<?php

/**
 * Aluno form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AlunoForm extends BaseAlunoForm
{
    public function configure()
    {
        parent::configure();

        unset (
            $this['coordenador'],
            $this['senha'],
            $this['orientador_list']
        );
        
        $this->widgetSchema['curso_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Curso'), 'add_empty' => true));

        $this->validatorSchema['curso_id'] = new sfValidatorInteger(
            array(
                'required' => true
            )
        );

        $this->setDefault('type', 'aluno');
    }
}
