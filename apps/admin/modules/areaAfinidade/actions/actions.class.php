<?php

/**
 * areaAfinidade actions.
 *
 * @package    TCCtrl
 * @subpackage areaAfinidade
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class areaAfinidadeActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('AreaAfinidade')->createQuery('a');
        $this->pager = new sfDoctrinePager('AreaAfinidade', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->areasAfinidade = $this->pager->getResults();
    }

    public function executeList(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('AreaAfinidade')->listAreaAfinidadeProfessor($this->getUser()->getAttribute('id',null,'usuario'),false);
        $this->pager = new sfDoctrinePager('AreaAfinidade', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->areasAfinidade = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new AreaAfinidadeForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AreaAfinidadeForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
        $this->form = new AreaAfinidadeForm($area_afinidade);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
        $this->form = new AreaAfinidadeForm($area_afinidade);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($area_afinidade = Doctrine::getTable('AreaAfinidade')->find(array($request->getParameter('id'))), sprintf('Object area_afinidade does not exist (%s).', $request->getParameter('id')));
        $area_afinidade->delete();

        $this->getUser()->setFlash('success', 'Área de Afinidade excluída com sucesso!');
        $this->redirect('areaAfinidade/index');
    }

    public function executeVincular(sfWebRequest $request)
    {
        $professorAreaAfinidade = new ProfessorAreaAfinidade();
        $professorAreaAfinidade->professor_id = $this->getUser()->getAttribute('id',null,'usuario');
        $professorAreaAfinidade->area_afinidade_id = $request->getParameter('id');

        $professorAreaAfinidade->save();
        
        $this->getUser()->setFlash('success', 'Área de Afinidade vinculada com sucesso!');
        $this->redirect('areaAfinidade/list');
    }

    public function executeDesvincular(sfWebRequest $request)
    {
        $professor = Doctrine_Core::getTable('Professor')->find($this->getUser()->getAttribute('id',null,'usuario'));
        $professor->unlink('AreasAfinidade', array($request->getParameter('id')));

        $professor->save();

        $this->getUser()->setFlash('success', 'Área de Afinidade desvinculada com sucesso!');
        $this->redirect('areaAfinidade/list');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $area_afinidade = $form->save();

            $this->getUser()->setFlash('success','Área de afinidade ' . ($form->isNew() ? 'incluida' : 'alterada') . ' com sucesso!');
            $this->redirect('areaAfinidade/edit?id='.$area_afinidade->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }
}
