<?php

/**
 * aluno actions.
 *
 * @package    TCCtrl
 * @subpackage aluno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alunoActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Aluno')->createQuery('a');
        $this->pager = new sfDoctrinePager('Aluno', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->alunos = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new AlunoForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AlunoForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
        $this->form = new AlunoForm($aluno);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
        $this->form = new AlunoForm($aluno);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($aluno = Doctrine::getTable('Aluno')->find(array($request->getParameter('id'))), sprintf('Object aluno does not exist (%s).', $request->getParameter('id')));
        $aluno->delete();
        $this->getUser()->setFlash('success', 'Aluno excluído com sucesso!');
        $this->redirect('aluno/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()){
            $aluno = $form->save();
            if($request->isMethod(sfRequest::POST)){
                $senha = Util::generatePassword(8);
                $aluno->senha = $senha;
                $aluno->save();
                //envia a senha por e-mail
                $email = new SenhaMail(
                    $aluno->email,
                    array(
                        'sender' => $this->getUser()->getAttribute('email',null,'configuracao'),
                        'senha'  => $senha,
                        'url'    => $this->getUser()->getAttribute('url',null,'configuracao')
                    )
                );
                $email->send();
            }            
            
            $this->getUser()->setFlash('success','Aluno ' . ($form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!');
            $this->redirect('aluno/edit?id='.$aluno->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }

    }
}
