<?php

require_once '/home/hboaventura/projetos/TCCtrl/lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        $this->enablePlugins('sfDoctrinePlugin');
        
        //provisorio
        sfValidatorBase::setDefaultMessage('required', 'Campo obrigatório');
        sfValidatorBase::setDefaultMessage('invalid', 'Campo inválido');
    }
}
