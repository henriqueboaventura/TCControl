<?php


class AreaAfinidadeTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AreaAfinidade');
    }

    public function listAreaAfinidadeProfessor($professor, $execute = true)
    {
        $q = $this->createQuery()
           ->from('AreaAfinidade a')
           ->leftJoin('a.Professor p WITH p.id = ?',$professor);

        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }
}