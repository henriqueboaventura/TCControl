<?php 

class homeComponents extends sfComponents
{
    public function executeMenu()
    {
        if($this->getuser()->hasCredential('professor')){
            $this->orientacoesPendentes = Doctrine_Core::getTable('Orientacao')->findAlunosOrientacao($this->getUser()->getAttribute('id',null,'usuario'),array(0),true);
            $this->propostasPendentes = Doctrine::getTable('Proposta')->findPropostaByProfessor($this->getUser()->getAttribute('id',null,'usuario'),array(0),true);
        }
    }
}
