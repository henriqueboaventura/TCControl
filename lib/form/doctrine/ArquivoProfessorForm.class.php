<?php

/**
 * Arquivo form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ArquivoProfessorForm extends BaseArquivoForm
{
    public function configure()
    {
        unset(
            $this['created_at'],
            $this['updated_at'],
            $this['version']
        );

        $this->widgetSchema['remetente_id'] = new sfWidgetFormInputHidden();

        $this->widgetSchema['path'] = new sfWidgetFormInputFileEditable(array(
            'label'     => 'Arquivo',
            'file_src'  => '/uploads/arquivo/'.$this->getObject()->getPath(),
            //'is_image'  => true,
            'edit_mode' => !$this->isNew(),
            'with_delete' => false,
            'template'  => '<div class="file_field_download"><a href="%file%">Download</a><br />%input%<br />%delete% %delete_label%</div>',
        ));

        $this->widgetSchema['destinatario_id'] = new sfWidgetFormDoctrineChoice(array(
            'model' => 'Aluno',
            'add_empty' => true,
            'query' => Doctrine_Core::getTable('Aluno')->createQuery()
                        ->from('Aluno a')
                        ->innerJoin('a.Orientacao o','with','o.professor_id = ' . $this->getDefault('destinatario_id'))
                        ->where('o.status = 1')
        ));

        $this->widgetSchema['tipo'] = new sfWidgetFormChoice(array(
            'choices' => array(
                '' => 'Selecione',
                'modelagem' => 'Modelagem',
                'documento' => 'Documento',
                'imagem' => 'Imagem',
                'outro' => 'Outro'
            )
        ));

        $this->validatorSchema['path'] = new sfValidatorFile(array(
            'required'             => false,
            'path'                 => sfConfig::get('sf_upload_dir').'/arquivo',
        ));
    }

    public function save($conn = null)
    {
        $return = parent::save($conn);

        if($this->getObject()->getPath() != ''){
            //echo 'ha';die;
            
            $uploadDir = sfConfig::get('sf_upload_dir') . '/arquivo/';

            $file = explode('.',$this->getObject()->getPath());

            $novoNome = Util::generateSlug($this->getObject()->getNome()) . '_' . time() . '.' . $file[1];

            rename($uploadDir . $this->getObject()->getPath(), $uploadDir . $novoNome);

            $this->getObject()->setPath($novoNome);
            $this->getObject()->save();
        }
        return $return;
    }

}
