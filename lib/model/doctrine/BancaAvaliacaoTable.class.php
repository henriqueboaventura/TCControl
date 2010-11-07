<?php


class BancaAvaliacaoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('BancaAvaliacao');
    }

    public function listAguardandoAvaliacao($execute = true)
    {
        $q = $this->createQuery()
           ->from('Banca b')
           ->leftJoin('b.Avaliacao ba')
           ->where('ba.id IS NULL');

        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }
}