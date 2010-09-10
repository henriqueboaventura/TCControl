<h2>Perfil</h2>
<h3>Atualizar</h3>
<?php
    include_partial('global/form',array(
        'form'      => $form,
        'module'    => $sf_context->getModuleName(),
        'action'    => 'atualizar',
        'back_list' => false
    ));
?>