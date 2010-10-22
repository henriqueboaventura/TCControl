<?php

/**
 * Mensagem form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MensagemAlunoForm extends MensagemForm
{
    public function configure()
    {
        parent::configure();
        $choices = array('' => '');
     
        $this->widgetSchema['destinatario_id'] = new sfWidgetFormDoctrineChoice(
            array(
                'model' => 'Professor',
                'add_empty' => true
            )
        );

         $this->widgetSchema->setLabels(array(
            'destinatario_id' => 'Destinatário'
        ));
    }
    
}
