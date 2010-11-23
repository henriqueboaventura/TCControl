<?php


class ProfessorTable extends AcademicoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Professor');
    }
    
    public function findProfessorAlunos($execute = true) 
    {
        $q = $this->createQuery()
           ->from('Professor p')
           ->leftJoin('p.Orientandos o');
           //->leftJoin('o.Aluno a');
        
        if($execute){
            $q->execute();
        }
           
        return $q;
    }
}