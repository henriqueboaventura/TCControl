<?php use_helper('Date');?>
<h2>Proposta</h2>
<h3>Visualizar</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<h4>Proposta de Desenvolvimento</h4>
<dl>
    <dt><span>Título do Trabalho</span> <?php echo link_to('Adicionar Comentário','@proposta_add_comment?proposta_id=' . $proposta->id . '&local=titulo', array('class' => 'comment_add')); ?></dt>
    <dd><?php echo $proposta->titulo; ?></dd>
    <dt><span>Descrição do Problema</span> <?php echo link_to('Adicionar Comentário','@proposta_add_comment?proposta_id=' . $proposta->id . '&local=descricao_problema', array('class' => 'comment_add')); ?></dt>
    <dd><?php echo $proposta->descricao_problema; ?></dd>
    <dt><span>Descrição da Solução</span> <?php echo link_to('Adicionar Comentário','@proposta_add_comment?proposta_id=' . $proposta->id . '&local=descricao_solucao', array('class' => 'comment_add')); ?></dt>
    <dd><?php echo $proposta->descricao_solucao; ?></dd>
    <dt><span>Objetivos</span> <?php echo link_to('Adicionar Comentário','@proposta_add_comment?proposta_id=' . $proposta->id . '&local=objetivos', array('class' => 'comment_add')); ?></dt>
    <dd><?php echo $proposta->objetivos; ?></dd>
</dl>
<h4>Cronograma</h4>
<?php for($i = 1; $i <= 2; $i++): ?>
<h5>TCC <?php echo $i; ?></h5>
<table>
    <thead>
        <tr>
            <th><?php echo __('Atividade');?></th>
            <th><?php echo __('Produto');?></th>
            <th><?php echo __('Entrega');?></th>
            <th><?php echo __('Detalhamento');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($etapa[$i] as $cronograma): ?>
        <tr>
            <td><?php echo $cronograma->getAtividade() ?></td>
            <td><?php echo $cronograma->getProduto() ?></td>
            <td><?php echo format_date($cronograma->getDataEntrega(),'dd/MM/yy'); ?></td>
            <td><?php echo $cronograma->getDetalhamento() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endfor; ?>
