<h2><?php echo __('Mensagem');?></h2>
<h3><?php echo __('Nova');?></h3>
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
