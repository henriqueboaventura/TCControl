<h2>Artigo</h2>
<h3>Visualizar</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to('Adicionar Comentário','@artigo_add_comment?artigo_id=' . $artigo->id , array('class' => 'comment_add')); ?>
<hr />
<?php echo $artigo->conteudo ?>