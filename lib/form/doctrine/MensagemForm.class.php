<?php

/**
 * Mensagem form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MensagemForm extends BaseMensagemForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['lido']
        );           
        
        $this->widgetSchema['remetente_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['conteudo'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));       
        $this->widgetSchema['original_id'] = new sfWidgetFormInputHidden();

        $this->validatorSchema['destinatario_id'] = new sfValidatorDoctrineChoice(
            array(
                'model' => $this->getRelatedModelName('Destinatario'),
                'required' => true
            )
        );

        $this->widgetSchema->setLabels(array(
            'destinatario_id' => 'Destinatário',
            'conteudo' => 'Conteúdo',
        ));
    }

    
}
