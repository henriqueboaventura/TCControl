<?php


class CronogramaTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Cronograma');
    }

    public function findCronogramaByAluno($aluno, $etapa = null)
    {
        $q = $this->createQuery()
           ->from('Cronograma c')
           ->innerJoin('c.Proposta p')
           //->innerJoin('p.aluno a')
           ->where('p.aluno_id = ?', $aluno);

        if(!is_null($etapa)){
            $q->andWhere('c.etapa = ?', $etapa);
        }

        $q->orderBy('c.data_entrega');

        return $q->execute();
    }
}