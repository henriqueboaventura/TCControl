<h2><?php echo __('Documento');?></h2>
<h3><?php echo __('Adicionar Comentário');?></h3>
<?php
    include_partial(
        'global/form',
        array(
            'form' => $form,
            'action' => 'newComment?artigo_id=' . $sf_request->getParameter('artigo_id'),
            'module' => $sf_context->getModuleName(),
            'back_list' => false
        )
    );
?>
<h4>Comentários</h4>
<ul class="comentarios">
    <?php foreach($comentarios as $comentario):?>
    <li>
        <span><?php echo format_date($comentario->created_at); ?></span> - <?php echo $comentario->conteudo;?>
    </li>
    <?php endforeach;?>
</ul>