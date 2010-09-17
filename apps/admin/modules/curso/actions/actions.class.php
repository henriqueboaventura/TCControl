<?php

/**
 * curso actions.
 *
 * @package    TCCtrl
 * @subpackage curso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cursoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Curso')->createQuery('a');
        $this->pager = new sfDoctrinePager('Curso', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->cursos = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CursoForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CursoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($curso = Doctrine::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
        $this->form = new CursoForm($curso);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($curso = Doctrine::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
        $this->form = new CursoForm($curso);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($curso = Doctrine::getTable('Curso')->find(array($request->getParameter('id'))), sprintf('Object curso does not exist (%s).', $request->getParameter('id')));
        $curso->delete();
        
        $this->getUser()->setFlash('success', 'Curso excluído com sucesso!');
        $this->redirect('curso/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $curso = $form->save();
            $this->getUser()->setFlash('success','Curso ' . ($form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!');
            $this->redirect('curso/edit?id='.$curso->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }
}
