<?php

/**
 * PropostaAvaliacao form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PropostaAvaliacaoForm extends BasePropostaAvaliacaoForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema['proposta_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['aprovada'] = new sfWidgetFormInputHidden();
    }
}
