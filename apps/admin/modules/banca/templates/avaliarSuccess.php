<h2><?php echo __('Banca');?></h2>
<h3><?php echo __('Avaliar banca do Aluno ') . $banca->Aluno->nome;?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'action' => 'avaliar?id=' . $banca->id,
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'back_list' => true
        )
    );
?>
