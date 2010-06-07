<?php


class AcademicoTable extends UsuarioTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Academico');
    }
}