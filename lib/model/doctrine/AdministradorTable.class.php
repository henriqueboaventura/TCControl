<?php


class AdministradorTable extends UsuarioTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Administrador');
    }
}