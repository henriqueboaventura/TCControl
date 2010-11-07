<?php

/**
 * BancaAvaliacao form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BancaAvaliacaoForm extends BaseBancaAvaliacaoForm
{
    public function configure()
    {

        $this->widgetSchema['banca_id'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['parecer'] = new sfWidgetFormCKEditor(sfConfig::get('app_ckeditor_default_config'));

        $this->widgetSchema['avaliacao_professor_1'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D')));
        $this->widgetSchema['avaliacao_professor_2'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D')));
        $this->widgetSchema['avaliacao_geral'] = new sfWidgetFormChoice(array('choices' => array('' => '', 'A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D')));

        $this->widgetSchema->setLabels(array(
            'avaliacao_geral' => 'Avalição Geral'
        ));
    }

    public function setLabelProfessor($id, $nome)
    {
        $this->widgetSchema->setLabel('avaliacao_professor_' . $id, 'Avalição do prof. ' . $nome);
    }
}
