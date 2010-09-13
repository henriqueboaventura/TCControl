<?php


class OrientacaoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Orientacao');
    }
    
    public function findAlunosOrientacao($professor, $status = array(0,1,2), $execute = true) {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->innerJoin('a.Orientacao o')
           ->where('o.professor_id = ?', $professor)
           ->andWhere('o.status IN ?',$status);
        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }
    
    public function findOrientacao($professor, $aluno)
    {
        $q = $this->createQuery()
           ->from('Orientacao o')
           ->where('o.professor_id = ?', $professor)
           ->andWhere('o.aluno_id = ?', $aluno)
           ->fetchone();
           
        return $q;
    }
}
