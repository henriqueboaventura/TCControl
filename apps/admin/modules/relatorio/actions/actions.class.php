<?php

/**
 * relatorio actions.
 *
 * @package    TCCtrl
 * @subpackage relatorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class relatorioActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        switch($request->getParameter('tipo')){
        case 'alunosMatriculados':
            $query = Doctrine::getTable('Aluno')->findAlunosMatriculados(false);
            
            break;
        case 'alunosOrientador':
            $query = Doctrine::getTable('Aluno')->findAlunosMatriculados(false);
            
            break;
        case 'propostas':
            $query = Doctrine::getTable('Proposta')->findPropostasAlunos(false);
            
            break;
        case 'orientadorAlunos':
            $query = Doctrine::getTable('Professor')->findProfessorAlunos(false);
            
            break;
        case 'horarioBancas':
            $query = Doctrine::getTable('Aluno')->findAlunosBanca(false);
            
            break;
        case 'resultadoBancas':
            $query = Doctrine::getTable('Aluno')->findAlunosBanca(false);
            
            break;
        }
        
        $this->setTemplate($request->getParameter('tipo'));
        
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $this->pager = new sfDoctrinePager('Consulta',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->registros = $this->pager->getResults();
    }
}
