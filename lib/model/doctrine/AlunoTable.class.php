<?php


class AlunoTable extends AcademicoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Aluno');
    }

    public function findOrientacao($aluno) {
        $q = $this->createQuery()
           ->from('Orientacao o')
           ->where('(o.aceito = NULL OR o.aceito = true)')
           ->where('o.aluno_id = ?', $aluno)
           ->fetchOne();

        return $q;
    }



}