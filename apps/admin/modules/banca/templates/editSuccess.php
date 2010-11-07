<h2><?php echo __('Banca');?></h2>
<h3><?php echo __('Alterar banca do aluno ') . $banca->Aluno->nome;?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'back_list' => true
        )
    );
?>
