<?php


class MensagemTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Mensagem');
    }
    
    public function findMensagens($usuario, $returnQuery = false)
    {
        $q = $this->createQuery()
           ->from('Mensagem m')
           ->leftJoin('m.Remetente r')
           ->leftJoin('m.Destinatario d')
           ->where('d.id = ?', $usuario);


        if($returnQuery){
            return $q;
        }

        return $q->execute();;
    }
}