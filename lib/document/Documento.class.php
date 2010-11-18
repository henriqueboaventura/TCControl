<?php
/**
 * Classe abstrata representando um documento de sistema(termos, atas, etc)
 *
 *
 * @package Lib
 * @subpackage Document
 * @version $Id$
 */
abstract class Documento
{
    const DOCUMENT_FILE_NAME = null;
    const DOCUMENT_TOP = 780;
    const DOCUMENT_LEFT = 60;
    const DOCUMENT_RIGHT = 540;
    const DOCUMENT_BOTTOM = 80;
    
    protected $document = null;

    public function __construct()
    {
        ProjectConfiguration::registerZend();
        
        $this->document = new Zend_Pdf();
    }

    public function save($destination = null)
    {
        $this->process();
        $destination = $destination ?: $this->getDestinationFile(static::DOCUMENT_FILE_NAME, array() );
        $this->document->save($destination);
        
        return $destination;
    }
    
    public function getDestinationFile($doc_filename, $subs)
    {
        $path = sfConfig::get('app_document_savepath');
        $path = $this->translateDestinationPath(array_keys($subs),array_values($subs),$path);
        if(false === file_exists($path)){
            mkdir($path, 0777, TRUE);
            chmod($path, 0777);
        }
        return $path.$doc_filename;
        
    }
    
    public function translateDestinationPath($from, $to, $path)
    {
        $path = str_replace($from, $to, $path);
        return $path;
    }
    
    public static function getGeneratedFile()
    {

        return sfConfig::get('app_document_savepath').static::DOCUMENT_FILE_NAME;
    }
    
    public static function getGeneratedFilePath()
    {
        return str_replace(sfConfig::get('sf_web_dir'), '', static::getGeneratedFile());
    }
    
}
