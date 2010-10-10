<?php

/**
 * ArtigoComentario form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArtigoComentarioForm extends BaseArtigoComentarioForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at']
        );

        $this->widgetSchema['artigo_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['lido'] = new sfWidgetFormInputHidden();

        $this->widgetSchema['conteudo']->setLabel('Comentário');

        $this->setDefault('lido', false);
    }
}
