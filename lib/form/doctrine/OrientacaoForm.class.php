<?php

/**
 * Orientacao form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrientacaoForm extends BaseOrientacaoForm
{
    public function configure()
    {        
        $this->widgetSchema['professor_id'] = new sfWidgetFormDoctrineChoice(array('model' => 'Professor'));
        $this->widgetSchema['status'] = new sfWidgetFormInputHidden();
        
        $this->validatorSchema['aluno_id'] = new sfValidatorInteger(array('required' => true));
        $this->validatorSchema['professor_id'] = new sfValidatorInteger(array('required' => true));
        
        //por padrao, deixa aprovado
        $this->setDefault('status',1);
    }
}
