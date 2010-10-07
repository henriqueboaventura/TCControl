<h2><?php echo __('Artigo');?></h2>
<h3><?php echo __('Comparar Versões');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'action' => 'artigo/compare',
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'back_list' => false
        )
    );
?>
