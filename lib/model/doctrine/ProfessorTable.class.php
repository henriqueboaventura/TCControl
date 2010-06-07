<?php


class ProfessorTable extends AcademicoTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Professor');
    }
}