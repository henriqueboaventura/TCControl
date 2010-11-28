<?php 

class homeComponents extends sfComponents
{
    public function executeMenu()
    {
        if($this->getuser()->hasCredential('professor')){
            $this->orientacoesPendentes = Doctrine_Core::getTable('Orientacao')->findAlunosOrientacao($this->getUser()->getAttribute('id',null,'usuario'),array(0),true);
            $this->orientacoesExtraPendentes = Doctrine::getTable('Orientacao')->findOrientacoesPendentes(
                $this->getUser()->getAttribute('curso',null,'usuario'),
                $this->getUser()->getAttribute('alunos_por_professor',null,'configuracao'),
                true
            );
            $this->propostasPendentes = Doctrine::getTable('Proposta')->findPropostaByProfessor($this->getUser()->getAttribute('id',null,'usuario'),'aguardando',true);
        }
        
        if($this->getuser()->hasCredential('aluno')){
            $tcc = Doctrine::getTable('TCC')->findByAluno($this->getUser()->getAttribute('id',null,'usuario'));
            $this->etapa = $tcc->getLast()->etapa;
        }
    }
}
