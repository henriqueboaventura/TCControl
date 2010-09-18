<?php

/**
 * administrador actions.
 *
 * @package    TCCtrl
 * @subpackage administrador
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class administradorActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $page = ($request->getParameter('page') != '') ? $request->getParameter('page') : 1;
        $query = Doctrine_Core::getTable('Administrador')->createQuery('a');
        $this->pager = new sfDoctrinePager('Administrador', sfConfig::get('app_registers_per_page'));
        $this->pager->setQuery($query);
        $this->pager->setPage($page);
        $this->pager->init();

        $this->administradors = $this->pager->getResults();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new AdministradorForm();
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new AdministradorForm();        

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($administrador = Doctrine::getTable('Administrador')->find(array($request->getParameter('id'))), sprintf('Object administrador does not exist (%s).', $request->getParameter('id')));
        $this->form = new AdministradorForm($administrador);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($administrador = Doctrine::getTable('Administrador')->find(array($request->getParameter('id'))), sprintf('Object administrador does not exist (%s).', $request->getParameter('id')));
        $this->form = new AdministradorForm($administrador);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($administrador = Doctrine::getTable('Administrador')->find(array($request->getParameter('id'))), sprintf('Object administrador does not exist (%s).', $request->getParameter('id')));
        $administrador->delete();

        $this->getUser()->setFlash('success', 'Administrador excluído com sucesso!');
        $this->redirect('administrador/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $administrador = $form->save();
            if($request->isMethod(sfRequest::POST)){
                $senha = Util::generatePassword(8);
                $administrador->senha = $senha;
                $administrador->save();
                //envia a senha por e-mail
                $email = new SenhaMail(
                    $administrador->email,
                    array(
                        'sender' => $this->getUser()->getAttribute('email',null,'configuracao'),
                        'senha'  => $senha,
                        'url'    => $this->getUser()->getAttribute('url',null,'configuracao')
                    )
                );
                $email->send();
            }
            $this->getUser()->setFlash('success','Administrador ' . ($form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!');
            $this->redirect('administrador/edit?id='.$administrador->getId());
        } else {
            $this->getUser()->setFlash('error', 'O formulário contém erros!',false);
        }
    }
}
