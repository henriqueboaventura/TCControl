<?php


class ArtigoTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Artigo');
    }
    
    public function findArtigoAluno($aluno, $lidos = true)
    {
        $q = $this->createQuery()
           ->from('Artigo a')
           //->leftJoin('p.Comentarios co WITH co.lido = ?', $lidos)
           ->where('a.aluno_id = ?', $aluno);

        return $q->fetchOne();
    }
}
