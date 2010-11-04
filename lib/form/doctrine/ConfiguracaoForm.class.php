<?php

/**
 * Configuracao form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConfiguracaoForm extends BaseConfiguracaoForm
{
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['created_at'],
            $this['updated_at']
        );
        
        $this->widgetSchema['data_entrega_tcc1'] = new widgetFormJQueryDate(array(
            'culture' => 'pt-BR',
        ));
        
        $this->widgetSchema['data_entrega_tcc2'] = new widgetFormJQueryDate(array(
            'culture' => 'pt-BR',
        ));
        
        $this->setValidator('email', new sfValidatorEmail());
        $this->setValidator('url', new sfValidatorURL());
        $this->setValidator('data_entrega_tcc1', new sfValidatorDate(array(
            'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~',
            'required'    => true
        )));
        $this->setValidator('data_entrega_tcc2', new sfValidatorDate(array(
            'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~',
            'required'    => true
        )));
        
        $this->widgetSchema->setLabels(array(
            'instituicao'       => 'Instituição',
            'email'             => 'E-mail',
            'url'               => 'URL do sistema',
            'data_entrega_tcc1' => 'Data de Entrega do TCC 1',
            'data_entrega_tcc2' => 'Data de Entrega do TCC 2'
        ));
        
    }
}
