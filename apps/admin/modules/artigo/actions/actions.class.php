<?php

/**
 * artigo actions.
 *
 * @package    TCCtrl
 * @subpackage artigo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class artigoActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeEdit(sfWebRequest $request)
    {                
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');

        $this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno,false);
        
        /*$comentarios = array();
        foreach($this->proposta->Comentarios as $comentario){
            $comentarios[$comentario->local][] = $comentario;
        }
        
        $this->comentarios = $comentarios;*/
        
        if($this->artigo){
            $this->form = new ArtigoForm($this->artigo);
        } else {
            $this->form = new ArtigoForm();
            $this->form->setDefault('aluno_id', $aluno);
        }
        
        if($request->isMethod(sfRequest::POST) OR $request->isMethod(sfRequest::PUT)){
            $this->form->bind(
                $request->getParameter($this->form->getName()), 
                $request->getFiles($this->form->getName())
            );
            
            if($this->form->isValid()){ 
                $this->form->save();
                $this->getUser()->setFlash('success','Artigo ' . ($this->form->isNew() ? 'incluído' : 'alterado') . ' com sucesso!', false);
            } else {
                $this->getUser()->setFlash('error', 'O formulário contém erros!',false);    
            }
            
        } 
    }

    public function executeCompare(sfWebRequest $request)
    {
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');
        $this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno,false);

        $this->form = new CompareForm(array('artigo_id' => $this->artigo->id));
    }
}
