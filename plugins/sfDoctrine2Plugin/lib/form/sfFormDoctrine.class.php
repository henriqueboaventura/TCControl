<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * (c) Jonathan H. Wage <jonwage@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony
 * @subpackage doctrine
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @author     Russell Flynn <russ@eatmymonkeydust.com>
 * @version    SVN: $Id: sfFormDoctrine.class.php 7845 2008-03-12 22:36:14Z fabien $
 */

/**
 * sfFormDoctrine is the base class for forms based on Doctrine objects.
 *
 * This class extends BaseForm, a class generated automatically with each new project.
 *
 * @package    symfony
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @author     Russell Flynn <russ@eatmymonkeydust.com>
 * @version    SVN: $Id: sfFormDoctrine.class.php 7845 2008-03-12 22:36:14Z fabien $
 */
abstract class sfFormDoctrine extends sfFormObject
{
  protected
    $isNew  = null,
    $object = null,
    $em;

  /**
   * Constructor.
   *
   * @param BaseObject A Doctrine object used to initialize default values
   * @param array      An array of options
   * @param string     A CSRF secret (false to disable CSRF protection, null to use the global CSRF secret)
   *
   * @see sfForm
   */
  public function __construct(\Doctrine\ORM\EntityManager $em, $object = null, $options = array(), $CSRFSecret = null)
  {
    $this->em = $em;
    $class = $this->getModelName();
    if ($object)
    {
      if (!($object instanceof $class))
      {
        throw new sfException(sprintf('The "%s" form only accepts a "%s" object.', get_class($this), $class));
      }
      $this->object = $object;
    }
    else
    {
      $this->isNew  = true;
      $this->object = new $class();
    }

    parent::__construct(array(), $options, $CSRFSecret);

    $this->updateDefaultsFromObject();
  }

  /**
   * Returns the default connection for the current model.
   *
   * @return Connection A database connection
   */
  public function getConnection()
  {
    return $this->em->getConnection();
  }

  public function getEntityManager()
  {
    return $this->em;
  }

  /**
   * Returns true if the current form embeds a new object.
   *
   * @return Boolean true if the current form embeds a new object, false otherwise
   */
  public function isNew()
  {
    if (is_null($this->isNew))
    {
      $id = $this->em->getMetadataFactory()->getMetadataFor(get_class($this->object))->getIdentifierValues($this->object);
      $this->isNew = empty($id) ? true : false;
    }

    return $this->isNew;
  }

  /**
   * Embeds i18n objects into the current form.
   *
   * @param array   $cultures   An array of cultures
   * @param string  $decorator  A HTML decorator for the embedded form
   */
  public function embedI18n($cultures, $decorator = null)
  {
    throw new sfException('Not implemented');
    if (!$this->isI18n())
    {
      throw new sfException(sprintf('The model "%s" is not internationalized.', $this->getModelName()));
    }

    $class = $this->getI18nFormClass();
    foreach ($cultures as $culture)
    {
      // FIXME: When this method gets implemented, remember to update it for
      // not-active-record
      $i18nObject = $this->object->Translation[$culture];
      $i18n = new $class($i18nObject);
      unset($i18n['id'], $i18n['lang']);

      $this->embedForm($culture, $i18n, $decorator);
    }
  }

  /**
   * Embed a Doctrine_Collection relationship in to a form
   *
   *     [php]
   *     $userForm = new UserForm($user);
   *     $userForm->embedRelation('Groups');
   *
   * @param  string $relationName  The name of the relation
   * @param  string $formClass     The name of the form class to use
   * @param  array  $formArguments Arguments to pass to the constructor (related object will be shifted onto the front)
   *
   * @throws InvalidArgumentException If the relationship is not a collection
   */
  public function embedRelation($relationName, $formClass = null, $formArgs = array())
  {
    // FIXME: Where exactly is getTable() declared?
    //        It triggers __call() which retrieves a property called $table,
    //        which doesn't seem to be declared anywhere so it triggers __get()
    //        which then again tries to call getTable() (if it exists) or
    //        returns $this->table, which eventually doesn't exists?
    //        I don't think this is works
    throw new sfException('Not implemented');
    $relation = $this->object->getTable()->getRelation($relationName);

    if ($relation->getType() !== Doctrine_Relation::MANY)
    {
      throw new InvalidArgumentException('You can only embed a relationship that is a collection.');
    }

    $r = new ReflectionClass(null === $formClass ? $relation->getClass().'Form' : $formClass);

    $subForm = new sfForm();
    foreach ($this->object[$relationName] as $index => $childObject)
    {
      $form = $r->newInstanceArgs(array_merge(array($childObject), $formArgs));

      $subForm->embedForm($index, $form);
      $subForm->getWidgetSchema()->setLabel($index, (string) $childObject);
    }

    $this->embedForm($relationName, $subForm);
  }

  /**
   * Returns the current object for this form.
   *
   * @return BaseObject The current object.
   */
  public function getObject()
  {
    return $this->object;
  }

  /**
   * Binds the current form and save the to the database in one step.
   *
   * @param  array      An array of tainted values to use to bind the form
   * @param  array      An array of uploaded files (in the $_FILES or $_GET format)
   * @param  EntityManager An optional Doctrine Connection object
   *
   * @return Boolean    true if the form is valid, false otherwise
   */
  public function bindAndSave($taintedValues, $taintedFiles = null, $em = null)
  {
    $this->bind($taintedValues, $taintedFiles);
    if ($this->isValid())
    {
      $this->save($em);

      return true;
    }

    return false;
  }

  /**
   * Saves the current object to the database.
   *
   * The object saving is done in a transaction and handled by the doSave() method.
   *
   * If the form is not valid, it throws an sfValidatorError.
   *
   * @param EntityManager An optional EntityManager object
   *
   * @return object The current saved object
   *
   * @see doSave()
   */
  public function save($em = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (null === $em)
    {
      $em = $this->getEntityManager();
    }

    try
    {
      $con = $em->getConnection();
      $con->beginTransaction();

      $this->doSave($em);

      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollback();

      throw $e;
    }

    return $this->object;
  }

  /**
   * Updates the values of the object with the cleaned up values.
   *
   * @param  array $values An array of values
   *
   * @return BaseObject The current updated object
   */
  public function updateObject($values = null)
  {
    if (null === $values)
    {
      $values = $this->values;
    }

    $values = $this->processValues($values);

    $this->doUpdateObject($values);

    // embedded forms
    $this->updateObjectEmbeddedForms($values);

    return $this->object;
  }

  /**
   * Updates the values of the object with the cleaned up values.
   *
   * If you want to add some logic before updating or update other associated
   * objects, this is the method to override.
   *
   * @param array $values An array of values
   */
  protected function doUpdateObject($values)
  {

    $md = $this->em->getMetadataFactory()->getMetadataFor($this->getModelName());
    $obj = $this->getObject();
    foreach($values as $key => $value)
    {
      $setMethod = "set".$key;
      if (method_exists($obj, $setMethod) && !in_array($key, $md->getIdentifierFieldNames()))
      {
        call_user_func_array(array($obj, $setMethod), array($value));
      }
      else
      {
        $md->setFieldValue($obj, $key, $value);
      }
    }
  }

  /**
   * Updates the values of the objects in embedded forms.
   *
   * @param array $values An array of values
   * @param array $forms  An array of forms
   */
  public function updateObjectEmbeddedForms($values, $forms = null)
  {
    if (null === $forms)
    {
      $forms = $this->embeddedForms;
    }

    foreach ($forms as $name => $form)
    {
      if (!isset($values[$name]) || !is_array($values[$name]))
      {
        continue;
      }

      if ($form instanceof sfFormDoctrine)
      {
        $form->updateObject($values[$name]);
      }
      else
      {
        $this->updateObjectEmbeddedForms($values[$name], $form->getEmbeddedForms());
      }
    }
  }

  /**
   * Processes cleaned up values with user defined methods.
   *
   * To process a value before it is used by the updateObject() method,
   * you need to define an updateXXXColumn() method where XXX is the PHP name
   * of the column.
   *
   * The method must return the processed value or false to remove the value
   * from the array of cleaned up values.
   *
   * @return array An array of cleaned up values processed by the user defined methods
   */
  public function processValues($values = null)
  {
    // see if the user has overridden some column setter
    $valuesToProcess = $values;
    foreach ($valuesToProcess as $field => $value)
    {
      $method = sprintf('update%sColumn', $this->camelize($field));

      if (method_exists($this, $method))
      {
        if (false === $ret = $this->$method($value))
        {
          unset($values[$field]);
        }
        else
        {
          $values[$field] = $ret;
        }
      }
      else
      {
        // save files
        if ($this->validatorSchema[$field] instanceof sfValidatorFile)
        {
          $values[$field] = $this->processUploadedFile($field, null, $valuesToProcess);
        }
      }
    }

    return $values;
  }

  /**
   * Returns true if the current form has some associated i18n objects.
   *
   * @return Boolean true if the current form has some associated i18n objects, false otherwise
   */
  public function isI18n()
  {
    return false;
  }

  /**
   * Returns the name of the i18n model.
   *
   * @return string The name of the i18n model
   */
  public function getI18nModelName()
  {
    return false;
  }

  /**
   * Returns the name of the i18n form class.
   *
   * @return string The name of the i18n form class
   */
  public function getI18nFormClass()
  {
    return false;
  }

  /**
   * Renders a form tag suitable for the related Doctrine object.
   *
   * The method is automatically guessed based on the Doctrine object:
   *
   *  * if the object is new, the method is POST
   *  * if the object already exists, the method is PUT
   *
   * @param  string $url         The URL for the action
   * @param  array  $attributes  An array of HTML attributes
   *
   * @return string An HTML representation of the opening form tag
   *
   * @see sfForm
   */
  public function renderFormTag($url, array $attributes = array())
  {
    if (!isset($attributes['method']))
    {
      $attributes['method'] = $this->isNew() ? 'post' : 'put';
    }

    return parent::renderFormTag($url, $attributes);
  }

  /**
   * Updates and saves the current object.
   *
   * If you want to add some logic before saving or save other associated objects,
   * this is the method to override.
   *
   * @param EntityManager An optional EntityManager object
   */
  protected function doSave($em = null)
  {
    if (null === $em)
    {
      $em = $this->getEntityManager();
    }

    $this->updateObject();

    $em->persist($this->object);

    // embedded forms
    $this->saveEmbeddedForms($em);

    $em->flush();
  }

  /**
   * Saves embedded form objects.
   *
   * @param EntityManager $em   An optional EntityManager object
   * @param array      $forms An array of forms
   */
  public function saveEmbeddedForms($em = null, $forms = null)
  {
    if (null === $em)
    {
      $em = $this->getEntityManager();
    }

    if (null === $forms)
    {
      $forms = $this->embeddedForms;
    }

    foreach ($forms as $form)
    {
      if ($form instanceof sfFormDoctrine)
      {
        $em->persist($form->getObject());
        $form->saveEmbeddedForms($em);
      }
      else
      {
        $this->saveEmbeddedForms($em, $form->getEmbeddedForms());
      }
    }
  }

  /**
   * Updates the default values of the form with the current values of the current object.
   */
  protected function updateDefaultsFromObject()
  {
    // update defaults for the main object
    $objdefault = $this->convertObjectToArray();

    if ($this->isNew())
    {
      $this->setDefaults(array_merge($objdefault, $this->getDefaults()));
    }
    else
    {
      $this->setDefaults(array_merge($this->getDefaults(), $objdefault));
    }

    $defaults = $this->getDefaults();

    foreach ($this->embeddedForms as $name => $form)
    {
      if ($form instanceof sfFormDoctrine)
      {
        $form->updateDefaultsFromObject();
        $defaults[$name] = $form->getDefaults();
      }
    }

    $this->setDefaults($defaults);
  }

  protected function getObjectValue($fields)
  {
    $md = $this->em->getMetadataFactory()->getMetadataFor($this->getModelName());
    $values = array();

    foreach ((array) $fields as $aField)
    {
      $values[] = $md->reflFields[$aField]->getValue($this->getObject());
    }

    if (is_array($fields))
    {
      return $values;
    }
    return current($values);
  }

  protected function convertObjectToArray()
  {
    $obj = $this->getObject();
    $valueArray = $this->getObjectColumnValues();

    foreach($valueArray as $key => $value)
    {
      $getMethod = "get".$key;
      if (method_exists($obj, $getMethod) && is_callable(array($obj, $getMethod)))
      {
        $valueArray[$key] = call_user_func(array($obj, $getMethod));
      }
    }

    return $valueArray;
  }

  /**
   * Get the property values of the form object for all properties mapped
   * to database columns
   *
   * @return array fieldname => $value
   */
  protected function getObjectColumnValues()
  {
    $md = $this->em->getMetadataFactory()->getMetadataFor($this->getModelName());
    $columns = array_keys($md->fieldNames);

    $values = array();
    foreach ($columns as $column) {
      $values[] = $md->reflFields[$md->fieldNames[$column]]->getValue($this->getObject());
    }
    $valueArray = array_combine($md->fieldNames, $values);

    return $valueArray;
  }

  /**
   * Saves the uploaded file for the given field.
   *
   * @param  string $field The field name
   * @param  string $filename The file name of the file to save
   * @param  array  $values An array of values
   *
   * @return string The filename used to save the file
   */
  protected function processUploadedFile($field, $filename = null, $values = null)
  {
    if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
    {
      throw new LogicException(sprintf('You cannot save the current file for field "%s" as the field is not a file.', $field));
    }

    if (null === $values)
    {
      $values = $this->values;
    }

    if (isset($values[$field.'_delete']) && $values[$field.'_delete'])
    {
      $this->removeFile($field);

      return '';
    }

    if (!$values[$field])
    {
      return $this->getObjectValue($field);
    }

    // we need the base directory
    if (!$this->validatorSchema[$field]->getOption('path'))
    {
      return $values[$field];
    }

    $this->removeFile($field);

    return $this->saveFile($field, $filename, $values[$field]);
  }

  /**
   * Removes the current file for the field.
   *
   * @param string $field The field name
   */
  protected function removeFile($field)
  {
    if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
    {
      throw new LogicException(sprintf('You cannot remove the current file for field "%s" as the field is not a file.', $field));
    }

    $fieldValue = $this->getObjectValue($field);
    if (($directory = $this->validatorSchema[$field]->getOption('path')) && is_file($directory.$fieldValue))
    {
      unlink($directory.$fieldValue);
    }
  }

  /**
   * Saves the current file for the field.
   *
   * @param  string          $field    The field name
   * @param  string          $filename The file name of the file to save
   * @param  sfValidatedFile $file     The validated file to save
   *
   * @return string The filename used to save the file
   */
  protected function saveFile($field, $filename = null, sfValidatedFile $file = null)
  {
    if (!$this->validatorSchema[$field] instanceof sfValidatorFile)
    {
      throw new LogicException(sprintf('You cannot save the current file for field "%s" as the field is not a file.', $field));
    }
    if (null === $file)
    {
      $file = $this->getValue($field);
    }

    $method = sprintf('generate%sFilename', $field);

    if (null !== $filename)
    {
      return $file->save($filename);
    }
    else if (method_exists($this->object, $method))
    {
      return $file->save($this->object->$method($file));
    }
    else
    {
      return $file->save();
    }
  }

  /**
   * Used in generated forms when models use inheritance.
   */
  protected function setupInheritance()
  {
  }

  protected function camelize($text)
  {
    return preg_replace(array('#/(.?)#e', '/(^|_|-)+(.)/e'), array("'::'.strtoupper('\\1')", "strtoupper('\\2')"), $text);
  }
}
