<?php use_helper('Date');?>
<h2>Mensagem</h2>
<h3>RE:<?php echo $mensagem->assunto; ?></h3>
<dl id="mensagem">
    <dt>Remetente:</dt>
    <dd><?php echo $mensagem->Remetente->nome; ?></dd>
    <dt>Data de Envio:</dt>
    <dd><?php echo format_date($mensagem->created_at,'d/M/yy'); ?> às  <?php echo format_date($mensagem->created_at,'HH:mm:ss'); ?></dd>
</dl>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'module' => $sf_context->getModuleName(),
            'action' => 'reply?id=' . $mensagem->id,
            'back_list' => true
        )
    );
?>
<!--<span id="actions_bar">
    <?php echo link_to(__('Voltar para a lista'), url_for('@mensagens')); ?>
    <?php echo link_to(__('Responder'), url_for('@mensagem_responder?id=' . $mensagem->id)); ?>
</span>-->