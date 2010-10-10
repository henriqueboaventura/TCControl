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
           ->leftJoin('a.Comentarios co WITH co.lido = ?', $lidos)
           ->where('a.aluno_id = ?', $aluno);

        return $q->fetchOne();
    }
    
    public function findVersoesArtigo($artigo)
    {
        Doctrine_Core::initializeModels(array('Artigo'));
        
        $q = $this->createQuery()
                  ->from('ArtigoVersao a')
                  ->where('a.id = ?', $artigo)
                  ->orderBy('a.version DESC');
                  
        return $q->execute();
    }

    public function findArtigoComentarios($artigo, $lidos = true)
    {
        $q = $this->createQuery()
           ->from('Artigo a')
           ->leftJoin('a.Comentarios co WITH co.lido = ?', $lidos)
           ->where('a.id = ?', $artigo);

        return $q->fetchOne();
    }

    public function findArtigoByProfessor($professor, $status = array(0,1,2), $execute = true) {
        $q = $this->createQuery()
           ->from('Artigo art')
           ->innerJoin('art.Aluno a')
           ->innerJoin('a.Orientacao o')
           ->innerJoin('a.Proposta prop')
           ->where('o.professor_id = ?', $professor)
           ->andWhere('art.status IN (' . implode(',',$status) . ')');

        if($execute){
            return $q->execute();
        } else {
            return $q;
        }
    }
}
