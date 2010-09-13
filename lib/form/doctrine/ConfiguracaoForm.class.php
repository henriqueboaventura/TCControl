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
        unset(
            $this['created_at'],
            $this['updated_at']
        );
        $this->widgetSchema->setLabels(array(
            'instituicao' => 'Instituição',
            'email'       => 'E-mail'
        ));

        $this->setValidator('email', new sfValidatorEmail());
    }
}
