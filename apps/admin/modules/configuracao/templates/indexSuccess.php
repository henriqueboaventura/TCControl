<h2><?php echo __('Configurações');?></h2>
<h3><?php echo __('Alterar');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'action' => 'index',
            'back_list' => false,
            'form' => $form,
            'module' => $sf_context->getModuleName()
            
        )
    );
?>
