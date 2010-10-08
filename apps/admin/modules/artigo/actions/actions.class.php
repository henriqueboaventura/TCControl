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

    public function executeHistorico(sfWebRequest $request)
    {
        $aluno = $this->getUser()->getAttribute('id', null, 'usuario');
        $versao = $request->getParameter('versao', null);
        
        $this->artigo = Doctrine_Core::getTable('Artigo')->findArtigoAluno($aluno, false);
        
        if($versao != null){
            $versaoInicial = $this->artigo->revert($versao);
            $versaoFinal = $this-artigo>revert((int)$versao - 1);
        } else {
            $versaoInicial = $this->artigo;
            $versaoFinal = $this->artigo->revert($this->artigo->version - 1);
        }
        
        $this->versoes = Doctrine::getTable('Artigo')->findVersoesArtigo($this->artigo->id);
                
           $text1 = $versaoInicial->conteudo;
            $text2 = $versaoFinal->conteudo;
         
             $htext1 = chunk_split($text1, 1, "\n");
             $htext2 = chunk_split($text2, 1, "\n");
         
             $hlines1 = str_split($htext1, 2);
             $hlines2 = str_split($htext2, 2);
         
            // perform diff, print output
            $diff = new Text_Diff($hlines1, $hlines2);
            $renderer = new Text_Diff_Renderer_inline(50000);
            //echo $renderer->render($diff);

        
        /*
        $f1 = htmlspecialchars($versaoInicial->conteudo);
        $f2 = htmlspecialchars($versaoFinal->conteudo);

        $lines1 = explode("\n",$f1);
        $lines2 = explode("\n",$f2);


        $diff = new Text_Diff('auto', array($lines1, $lines2));
        //$versaoInicial->conteudo, $versaoFinal->conteudo
        $renderer = new Text_Diff_Renderer_inline();
   
   
   $r_inline = new Text_Diff_Renderer_inline(
    array(
        'leading_context_lines' => 1,
        'trailing_context_lines' => 1,
        'ins_prefix' => '<span class="added">',
        'ins_suffix' => '</span>',
        'del_prefix' => '<span class="deleted">',
        'del_suffix' => '</span>'
    )
);*/
   
        $this->diff = $renderer->render($diff);
    }
}
