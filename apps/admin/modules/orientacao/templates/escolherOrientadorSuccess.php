<h2><?php echo __('Orientador');?></h2>
<h3><?php echo __('Escolher para o aluno ') . $aluno->nome;?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'action' => 'escolherOrientador?aluno_id=' . $sf_request->getParameter('aluno_id'),
            'back_list' => '@sem_orientador_list'
        )
    );
?>
