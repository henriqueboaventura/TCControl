<?php

require_once __DIR__ . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    public function setup()
    {
        $this->enablePlugins('sfDoctrinePlugin');
        
        //provisorio
        sfValidatorBase::setDefaultMessage('required', 'Campo obrigatório');
        sfValidatorBase::setDefaultMessage('invalid', 'Campo inválido');
        $this->enablePlugins('doAuthPlugin');
        $this->enablePlugins('sfCKEditorPlugin');
        $this->enablePlugins('sfFormExtraPlugin');
  }
}
