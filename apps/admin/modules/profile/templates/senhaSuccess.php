<h2><?php echo __('Perfil'); ?></h2>
<h3><?php echo __('Alterar Senha'); ?></h3>
<?php
    include_partial('global/form',array(
        'form'      => $form,
        'module'    => $sf_context->getModuleName(),
        'action'    => 'senha',
        'back_list' => false
    ));
?>