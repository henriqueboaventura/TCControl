<?php

class AlunosMatriculadosDoc extends Documento
{
    const DOCUMENT_FILE_NAME = 'AlunosMatriculados.pdf';
    const DOCUMENT_NAME = 'Alunos Matriculados';

    public $text;

    public function __construct() 
    {
        parent::__construct();
    }

    public static function getGeneratedFile()
    {

        return sfConfig::get('app_solicitacao_savepath').static::DOCUMENT_FILE_NAME;
    }

    public function process()
    {
        $configuracao = Doctrine::getTable('Configuracao')->find(1);

        $this->document->pages[] = ($page = $this->document->newPage(\Zend_Pdf_Page::SIZE_A4));

        //monta o cabecalho        
        $color = array();
        $color["black"] = new Zend_Pdf_Color_Html("#000000");

        $fontTitle = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_TIMES_BOLD);
        $size = 12;

        $styleTitle = new Zend_Pdf_Style();
        $styleTitle->setFont($fontTitle, $size);
        $styleTitle->setFillColor($color["black"]);

        $page->setStyle($styleTitle);
        $page->drawText($configuracao->instituicao, Documento::DOCUMENT_LEFT,Documento::DOCUMENT_TOP ,'UTF-8');

        $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_TIMES);
        $style = new Zend_Pdf_Style();
        $style->setFont($font, $size);
        $style->setFillColor($color["black"]);
        $page->setStyle($style);

        $text = wordwrap($this->text, 95, "\n", false);

        $token = strtok($text, "\n");

        $y = 665;
        while ($token != false) {
            if ($y < 100) {
                $this->document->pages[] = ($page = $this->document->newPage(Zend_Pdf_Page::SIZE_A4));
                $page->setStyle($style);
                $y = 665;
            } else {
                $y-=15;
            }
            $page->drawText($token, 60, $y, 'UTF-8');

            $token = strtok("\n");
        }
    }

}