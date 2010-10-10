<h2><?php echo __('Proposta');?></h2>
<h3><?php echo 'Parecer da ' . (($sf_request->getParameter('acao') == 'aceitar') ? 'aceitação' : 'rejeição');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'action' => 'parecer?id=' . $sf_request->getParameter('id') . '&acao=' . $sf_request->getParameter('acao'),
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'back_list' => true
        )
    );
?>
