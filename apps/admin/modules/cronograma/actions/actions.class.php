<?php

/**
 * cronograma actions.
 *
 * @package    TCCtrl
 * @subpackage cronograma
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cronogramaActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $aluno = $this->getUser()->getAttribute('id',null,'usuario');

        //verifica se o aluno ja cadastrou uma proposta
        $proposta = Doctrine::getTable('Proposta')->findOneByAlunoId($aluno);
        if(!$proposta){
            $this->getUser()->setFlash('error', 'Você deve definir primeiro sua proposta para atribuir um cronograma a ela!',false);

            return sfView::ERROR;
        }

        $this->cronogramasTCC1 = Doctrine::getTable('Cronograma')->findCronogramaByAluno($aluno, 1);
        $this->cronogramasTCC2 = Doctrine::getTable('Cronograma')->findCronogramaByAluno($aluno, 2);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new CronogramaForm();

        //recupera a proposta do aluno
        $aluno = $this->getUser()->getAttribute('id',null,'usuario');
        $proposta = Doctrine::getTable('Proposta')->findOneByAlunoId($aluno);
        if($proposta){
            $this->form->setDefault('proposta_id', $proposta->id);
        }
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new CronogramaForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
        $this->form = new CronogramaForm($cronograma);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
        $this->form = new CronogramaForm($cronograma);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($cronograma = Doctrine::getTable('Cronograma')->find(array($request->getParameter('id'))), sprintf('Object cronograma does not exist (%s).', $request->getParameter('id')));
        $cronograma->delete();

        $this->getUser()->setFlash('success', 'Cronograma excluído com sucesso!');
        $this->redirect('cronograma/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $cronograma = $form->save();

            $this->getUser()->setFlash('success','Cronograma ' . ($form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!');
            $this->redirect('cronograma/edit?id='.$cronograma->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }
}
