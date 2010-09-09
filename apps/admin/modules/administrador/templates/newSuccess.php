<h2><?php echo __('Administrador');?></h2>
<h3><?php echo __('Novo');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'module' => $sf_context->getModuleName()
        )
    );
?>