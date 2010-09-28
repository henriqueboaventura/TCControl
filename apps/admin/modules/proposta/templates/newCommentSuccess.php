<h2><?php echo __('Proposta');?></h2>
<h3><?php echo __('Adicionar Comentário');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'action' => 'newComment',
            'module' => $sf_context->getModuleName(),
            'back_list' => false
        )
    );
?>
