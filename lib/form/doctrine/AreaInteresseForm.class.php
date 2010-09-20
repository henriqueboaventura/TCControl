<?php

/**
 * AreaInteresse form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaInteresseForm extends BaseAreaInteresseForm
{
    public function configure()
    {
        $this->widgetSchema['professor_id'] = new sfWidgetFormInputHidden();
    }
}
