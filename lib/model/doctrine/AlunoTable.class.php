<?php


class AlunoTable extends AcademicoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Aluno');
    }
}