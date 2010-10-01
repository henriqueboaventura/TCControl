<h2><?php echo __('Proposta');?></h2>
<h3><?php echo __('Comentários');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<ul class="comentarios">
    <?php foreach($proposta->Comentarios as $comentario):?>
    <li>
        <span><?php echo format_date($comentario->created_at); ?></span> - 
        <?php echo $comentario->conteudo; ?> <?php echo link_to('Marcar como lido', '@proposta_comentario_read?proposta_id=' . $proposta->id . '&comentario_id=' . $comentario->id); ?>
    </li>
    <?php endforeach;?>
</ul>
<?php echo link_to(__('Voltar para a proposta'), url_for('@proposta')); ?>
