<?php

/**
 * BaseMensagem
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $remetente_id
 * @property integer $destinatario_id
 * @property integer $original_id
 * @property string $assunto
 * @property string $conteudo
 * @property boolean $lido
 * @property Usuario $Remetente
 * @property Usuario $Destinatario
 * @property Mensagem $Original
 * @property Doctrine_Collection $Mensagem
 * 
 * @method integer             getRemetenteId()     Returns the current record's "remetente_id" value
 * @method integer             getDestinatarioId()  Returns the current record's "destinatario_id" value
 * @method integer             getOriginalId()      Returns the current record's "original_id" value
 * @method string              getAssunto()         Returns the current record's "assunto" value
 * @method string              getConteudo()        Returns the current record's "conteudo" value
 * @method boolean             getLido()            Returns the current record's "lido" value
 * @method Usuario             getRemetente()       Returns the current record's "Remetente" value
 * @method Usuario             getDestinatario()    Returns the current record's "Destinatario" value
 * @method Mensagem            getOriginal()        Returns the current record's "Original" value
 * @method Doctrine_Collection getMensagem()        Returns the current record's "Mensagem" collection
 * @method Mensagem            setRemetenteId()     Sets the current record's "remetente_id" value
 * @method Mensagem            setDestinatarioId()  Sets the current record's "destinatario_id" value
 * @method Mensagem            setOriginalId()      Sets the current record's "original_id" value
 * @method Mensagem            setAssunto()         Sets the current record's "assunto" value
 * @method Mensagem            setConteudo()        Sets the current record's "conteudo" value
 * @method Mensagem            setLido()            Sets the current record's "lido" value
 * @method Mensagem            setRemetente()       Sets the current record's "Remetente" value
 * @method Mensagem            setDestinatario()    Sets the current record's "Destinatario" value
 * @method Mensagem            setOriginal()        Sets the current record's "Original" value
 * @method Mensagem            setMensagem()        Sets the current record's "Mensagem" collection
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseMensagem extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('mensagem');
        $this->hasColumn('remetente_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('destinatario_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('original_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('assunto', 'string', 150, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 150,
             ));
        $this->hasColumn('conteudo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('lido', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));

        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Usuario as Remetente', array(
             'local' => 'remetente_id',
             'foreign' => 'id'));

        $this->hasOne('Usuario as Destinatario', array(
             'local' => 'destinatario_id',
             'foreign' => 'id'));

        $this->hasOne('Mensagem as Original', array(
             'local' => 'original_id',
             'foreign' => 'id'));

        $this->hasMany('Mensagem', array(
             'local' => 'id',
             'foreign' => 'original_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}