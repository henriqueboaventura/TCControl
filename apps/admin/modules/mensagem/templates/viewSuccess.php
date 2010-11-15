<?php use_helper('Date');?>
<h2>Mensagem</h2>
<h3><?php echo $mensagem->assunto; ?></h3>
<dl id="mensagem">
    <dt>Remetente:</dt>
    <dd><?php echo $mensagem->Remetente->nome; ?></dd>
    <dt>Data de Envio:</dt>
    <dd><?php echo format_date($mensagem->created_at,'d/M/yy'); ?> às  <?php echo format_date($mensagem->created_at,'HH:mm:ss'); ?></dd>
    <dt>Mensagem:</dt>
    <dd><?php echo $mensagem->conteudo; ?></dd>
</dl>
<span id="actions_bar">
    <?php echo link_to(__('Voltar para a lista'), url_for('@mensagens')); ?>
    <?php echo ($mensagem->Remetente->id != $sf_user->getAttribute('id',null,'usuario')) ? link_to(__('Responder'), url_for('@mensagem_responder?id=' . $mensagem->id)) : ''; ?>
</span>