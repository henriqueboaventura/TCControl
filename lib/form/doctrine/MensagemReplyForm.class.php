<?php

/**
 * Mensagem form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MensagemReplyForm extends MensagemForm
{
    public function configure()
    {
        parent::configure();
        
        $this->widgetSchema['destinatario_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['assunto'] = new sfWidgetFormInputHidden();

        $this->widgetSchema['conteudo']->setLabel('Resposta');
    }    
}
