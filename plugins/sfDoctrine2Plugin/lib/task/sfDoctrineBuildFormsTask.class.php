<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/sfDoctrineBaseTask.class.php');

/**
 * Create form classes for the current model.
 *
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfDoctrineBuildFormsTask.class.php 12537 2008-11-01 14:43:27Z fabien $
 */
class sfDoctrineBuildFormsTask extends sfDoctrineBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('model-dir-name', null, sfCommandOption::PARAMETER_REQUIRED, 'The model dir name', 'model'),
      new sfCommandOption('form-dir-name', null, sfCommandOption::PARAMETER_REQUIRED, 'The form dir name', 'form'),
    ));

    $this->namespace = 'doctrine';
    $this->name = 'build-forms';
    $this->briefDescription = 'Creates form classes for the current model';

    $this->detailedDescription = <<<EOF
The [doctrine:build-forms|INFO] task creates form classes from the schema:

  [./symfony doctrine:build-forms|INFO]

The task read the schema information in [config/*schema.xml|COMMENT] and/or
[config/*schema.yml|COMMENT] from the project and all installed plugins.

The model form classes files are created in [lib/form|COMMENT].

This task never overrides custom classes in [lib/form|COMMENT].
It only replaces base classes generated in [lib/form/base|COMMENT].
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $this->logSection('doctrine', 'generating form classes');
    $databaseManager = $this->initDBM();
    $generatorManager = new sfGeneratorManager($this->configuration);
    $generatorManager->generate('sfDoctrineFormGenerator', array(
      'model_dir_name' => $options['model-dir-name'],
      'form_dir_name'  => $options['form-dir-name'],
      'database_manager' => $databaseManager,
    ));

    $properties = parse_ini_file(sfConfig::get('sf_config_dir').DIRECTORY_SEPARATOR.'properties.ini', true);

    $constants = array(
      'PROJECT_NAME' => isset($properties['symfony']['name']) ? $properties['symfony']['name'] : 'symfony',
      'AUTHOR_NAME'  => isset($properties['symfony']['author']) ? $properties['symfony']['author'] : 'Your name here'
    );

    // customize php and yml files
    $finder = sfFinder::type('file')->name('*.php');
    $this->getFilesystem()->replaceTokens($finder->in(sfConfig::get('sf_lib_dir').'/form/'), '##', '##', $constants);

    $this->reloadAutoload();
  }
}
