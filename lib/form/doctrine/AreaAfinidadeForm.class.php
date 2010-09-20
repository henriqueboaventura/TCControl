<?php

/**
 * AreaAfinidade form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaAfinidadeForm extends BaseAreaAfinidadeForm
{
    public function configure()
    {
        unset(
            $this['professores_list'],
            $this['slug']
        );
    }
}
