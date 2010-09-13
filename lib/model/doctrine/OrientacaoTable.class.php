<?php


class OrientacaoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Orientacao');
    }
    
    public function findAlunosOrientacao($professor, $execute = true) {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->innerJoin('a.Orientacao o')
           ->where('o.professor_id = ?', $professor);
        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }
}
