<?php

/**
 * BasePropostaComentario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $proposta_id
 * @property string $conteudo
 * @property enum $local
 * @property boolean $lido
 * @property Proposta $Proposta
 * 
 * @method integer            getPropostaId()  Returns the current record's "proposta_id" value
 * @method string             getConteudo()    Returns the current record's "conteudo" value
 * @method enum               getLocal()       Returns the current record's "local" value
 * @method boolean            getLido()        Returns the current record's "lido" value
 * @method Proposta           getProposta()    Returns the current record's "Proposta" value
 * @method PropostaComentario setPropostaId()  Sets the current record's "proposta_id" value
 * @method PropostaComentario setConteudo()    Sets the current record's "conteudo" value
 * @method PropostaComentario setLocal()       Sets the current record's "local" value
 * @method PropostaComentario setLido()        Sets the current record's "lido" value
 * @method PropostaComentario setProposta()    Sets the current record's "Proposta" value
 * 
 * @package    TCCtrl
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePropostaComentario extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('proposta_comentario');
        $this->hasColumn('proposta_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('conteudo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('local', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'titulo',
              1 => 'descricao_problema',
              2 => 'descricao_solucao',
              3 => 'objetivos',
             ),
             ));
        $this->hasColumn('lido', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             'notnull' => true,
             ));

        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Proposta', array(
             'local' => 'proposta_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}