<?php


class ArquivoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Arquivo');
    }

    public function findArquivos($usuario, $returnQuery = false)
    {
        $q = $this->createQuery()
           ->from('Arquivo a')
           ->leftJoin('a.Remetente r')
           ->leftJoin('a.Destinatario d')
           ->where('(r.id = ? OR d.id = ?)', array($usuario,$usuario));


        if($returnQuery){
            return $q;
        }

        return $q->execute();;
    }
    
    public function findTodosArquivos($returnQuery = false)
    {
        $q = $this->createQuery()
           ->from('Arquivo a')
           ->leftJoin('a.Remetente r')
           ->leftJoin('a.Destinatario d');

        if($returnQuery){
            return $q;
        }

        return $q->execute();;
    }
}