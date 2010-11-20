<?php

require_once __DIR__ . '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
    static protected $zendAutoLoader = false;

    public function setup()
    {
        $this->enablePlugins('sfDoctrinePlugin');
        
        //provisorio
        sfValidatorBase::setDefaultMessage('required', 'Campo obrigatório');
        sfValidatorBase::setDefaultMessage('invalid', 'Campo inválido');
        $this->enablePlugins('doAuthPlugin');
        $this->enablePlugins('sfCKEditorPlugin');
        $this->enablePlugins('sfFormExtraPlugin');
      $this->enablePlugins('sfTCPDFPlugin');
  }   
    
    static public function registerZend()
    {
        if(!self::$zendAutoLoader){
            set_include_path(implode(PATH_SEPARATOR, array(sfConfig::get('sf_lib_dir') . '/vendor/', get_include_path())));
            require_once 'Zend/Loader/Autoloader.php';

            self::$zendAutoLoader = Zend_Loader_Autoloader::getInstance();
        }

        return self::$zendAutoLoader;
    }

}
