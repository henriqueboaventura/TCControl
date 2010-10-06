<?php

/**
 * Artigo form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArtigoForm extends BaseArtigoForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['version']
        );
        
        $this->widgetSchema['aluno_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['conteudo'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));
        
        $this->widgetSchema->setLabels(array(            
            'conteudo' => 'Conteúdo'
        )); 
    }
}
