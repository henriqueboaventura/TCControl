<?php

/**
 * Cronograma form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CronogramaForm extends BaseCronogramaForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at']
        );

        $etapas = array(
            1 => 'TCC 1',
            2 => 'TCC 2'
        );

        $this->widgetSchema['proposta_id']  = new sfWidgetFormInputHidden();
        $this->widgetSchema['etapa']        = new sfWidgetFormChoice(array('choices' => $etapas));
        $this->widgetSchema['data_entrega'] = new widgetFormJQueryDate(array(
            'config'  => '{}',
            'culture' => 'pt-BR'
        ));
        $this->widgetSchema['detalhamento'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));

        $this->validatorSchema['data_entrega'] = new sfValidatorDate(array(
            'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~',
        ));

    }
}
