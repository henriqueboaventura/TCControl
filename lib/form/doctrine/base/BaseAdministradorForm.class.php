<?php

/**
 * Administrador form base class.
 *
 * @method Administrador getObject() Returns the current form's model object
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdministradorForm extends UsuarioForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('administrador[%s]');
  }

  public function getModelName()
  {
    return 'Administrador';
  }

}
