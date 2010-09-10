<?php

/**
 * Administrador form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdministradorForm extends BaseAdministradorForm
{
    public function configure()
    {
        parent::configure();

        unset (
            $this['matricula'],
            $this['endereco'],
            $this['fone_residencial'],
            $this['fone_celular'],
            $this['coordenador']
        );

        if(!$this->isNew()){
            unset($this['senha']);
        }

        $this->setDefault('type', 'administrador');
    }
}
