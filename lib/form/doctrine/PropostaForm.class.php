<?php

/**
 * Proposta form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PropostaForm extends BasePropostaForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['status']
        );
        
        $this->widgetSchema['aluno_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['descricao_problema'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));
        $this->widgetSchema['descricao_solucao'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));
        $this->widgetSchema['objetivos'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));
        
        $this->widgetSchema->setLabels(array(
            'descricao_problema' => 'Descrição do Problema',
            'descricao_solucao' => 'Descrição da Solução'
        )); 
    }
}
