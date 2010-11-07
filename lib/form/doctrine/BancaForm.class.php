<?php

/**
 * Banca form.
 *
 * @package    TCCtrl
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BancaForm extends BaseBancaForm
{
    public function configure()
    {
        if($this->isNew()){
            $this->widgetSchema['aluno_id'] = new sfWidgetFormDoctrineChoice(
                array(
                    'model' => $this->getRelatedModelName('Aluno'),
                    'add_empty' => true,
                    'query' => Doctrine::getTable('Aluno')->createQuery()
                               ->from('Aluno a')
                               ->where('a.id NOT IN (SELECT b.aluno_id FROM Banca b)')
                )
        );
        } else {
            $this->widgetSchema['aluno_id'] = new sfWidgetFormInputHidden();
        }
        $this->widgetSchema['professor_id_1'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador1'), 'add_empty' => true));
        $this->widgetSchema['professor_id_2'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avaliador2'), 'add_empty' => true));
        $this->widgetSchema['data_banca'] = new sfWidgetFormDateTime(array(
            'date' => array(
                'format' => '%day%/%month%/%year%',
                'years' => array_combine(range(date('Y'),date('Y') + 1),range(date('Y'),date('Y') + 1))
            ),
            'format' => '<fieldset class="date">%date% às %time% </fieldset>'
        ));

        $this->validatorSchema['data_banca'] = new sfValidatorDateTime(array(
            'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~',
            'required'    => true
        ));

        $this->widgetSchema->setLabels(array(
            'professor_id_1' => 'Avalidador 1',
            'professor_id_2' => 'Avalidador 2',
            'data_banca' => 'Data da Banca',
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array('callback' => array($this, 'checkData')))
        );
    }

    public function  checkData($validator, $values)
    {
        if($values['professor_id_1'] == $values['professor_id_2']){
            $error = new sfValidatorError($validator, 'Os Avaliadores devem ser diferentes');

            throw new sfValidatorErrorSchema($validator, array(
                'professor_id_1' => $error,
                'professor_id_2' => $error,
            ));
        }

        //verifica se os professores escolhidos nao sao o orientador
        $orientacao = Doctrine::getTable('Orientacao')->findOrientacoes(null, $values['aluno_id'], 1);
        if($orientacao[0]->Professor->id == $values['professor_id_1']){
            $error = new sfValidatorError($validator, 'O Avaliador não pode ser o Orientador');

            throw new sfValidatorErrorSchema($validator, array(
                'professor_id_1' => $error
            ));
        }
        if($orientacao[0]->Professor->id == $values['professor_id_2']){
            $error = new sfValidatorError($validator, 'O Avaliador não pode ser o Orientador');

            throw new sfValidatorErrorSchema($validator, array(
                'professor_id_2' => $error
            ));
        }

        return $values;
    }
}
