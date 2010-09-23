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
           ->andWhere('o.status IN ?',implode(',',$status));
        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }

    public function findAlunosOrientacaoCurso($curso, $professor, $status = array(0,1,2), $execute = true) {
        $q = $this->createQuery()
           ->from('Aluno a')
           ->innerJoin('a.Orientacao o')
           ->where('(a.curso_id = ? OR o.professor_id = ?)', array($curso, $professor))
           ->andWhere('o.status IN ?',implode(',',$status));
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
           ->fetchOne();
           
        return $q;
    }
    
    public function findOrientacoes($professor = null, $aluno = null, $status = null)
    {
        $q = $this->createQuery()
           ->from('Orientacao o');
        if(!is_null($professor)){
            $q->andWhere('o.professor_id = ?', $professor);
        } 
        if(!is_null($aluno)){
            $q->andWhere('o.aluno_id = ?', $aluno);
        }
        if(!is_null($status)){
            $q->andWhere('o.status = ?', $status);
        }
        
           
        return $q->execute();
    }
}
