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
    public function executeGenerate(sfWebRequest $request)
    {
        $documento = new AlunosMatriculadosDoc();
        $documento->save();
    }
}
