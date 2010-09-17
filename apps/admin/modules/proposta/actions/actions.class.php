<?php

/**
 * proposta actions.
 *
 * @package    TCCtrl
 * @subpackage proposta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propostaActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request)
    {                
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');
        
        $proposta = Doctrine_Core::getTable('Proposta')->findOneByAlunoId($aluno);
        
        if($proposta){
            $this->form = new PropostaForm($proposta);
        } else {
            $this->form = new PropostaForm();
            $this->form->setDefault('aluno_id', $aluno);
        }
        
        if($request->isMethod(sfRequest::POST) OR $request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()), 
                $request->getFiles($this->form->getName())
            );
            
            if($this->form->isValid()){ 
                $this->form->save();
                $this->getUser()->setFlash('success','Proposta ' . ($this->form->isNew() ? 'incluída' : 'alterada') . ' com sucesso!', false);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);    
            }
            
        } 
    }
}
