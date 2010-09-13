<?php

/**
 * orientacao actions.
 *
 * @package    TCCtrl
 * @subpackage orientacao
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orientacaoActions extends sfActions
{
    public function executeOrientadorList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Professor')->createQuery('a');
        $this->pager = new sfDoctrinePager('Professor',sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->professors= $this->pager->getResults();
    }

    public function executeSolicitar(sfWebRequest $request)
    {
        //verifica se o aluno ainda nao solicitou uma orientacao
        $orientacao = Doctrine_Core::getTable('Aluno')->findOrientacao($this->getUser()->getAttribute('id', null, 'usuario'));
        if(!$orientacao){
            $orientacao = new Orientacao();
            $orientacao->aluno_id = $this->getUser()->getAttribute('id', null, 'usuario');
            $orientacao->professor_id = $request->getParameter('professor_id');
            $orientacao->save();
        } else {
            if($orientacao->aceito == null){
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já tem uma aguardando aceitação');
            } else {
                $this->getUser()->setFlash('error', 'Você não pode solicitar uma nova orientação porque você já está sendo orientado por um professor');
            }
            
        }

        $this->redirect('@orientador_list');
    }
}
