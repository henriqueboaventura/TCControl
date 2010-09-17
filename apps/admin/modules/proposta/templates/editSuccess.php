<h2><?php echo __('Plano de Trabalho');?></h2>
<h3><?php echo __('Definir Proposta');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'action' => 'edit',
            'back_list' => true
        )
    );
?>
