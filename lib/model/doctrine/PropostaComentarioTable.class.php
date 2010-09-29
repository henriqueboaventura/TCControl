<?php


class PropostaComentarioTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('PropostaComentario');
    }

    public function getComentariosByLocal($proposta, $local)
    {
        $q = $this->createQuery()
           ->from('PropostaComentario p')
           ->where('p.proposta_id = ?', $proposta)
           ->andWhere('p.local = ?', $local)
           ->orderBy('p.created_at DESC');

        return $q->execute();
    }
}