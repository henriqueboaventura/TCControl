<h2><?php echo __('Cronograma');?></h2>
<h3><?php echo __('Alterar');?></h3>
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