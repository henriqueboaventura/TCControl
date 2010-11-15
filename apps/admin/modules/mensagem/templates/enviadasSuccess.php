<?php use_helper('Date'); ?>
<h2><?php echo __('Mensagens Enviadas');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Nova'),url_for('mensagem/new'));?>
<table>
    <thead>
        <tr>
            <th><?php echo __('Destinatário');?></th>
            <th><?php echo __('Assunto');?></th>
            <th><?php echo __('Data');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($mensagens as $mensagem): ?>
        <tr class="<?php echo ($mensagem->lido) ? 'read' : 'unread'; ?>">
            <td><?php echo $mensagem->Destinatario->nome; ?></td>
            <td><?php echo ((!is_null($mensagem->Original->id)) ? 'RE:' : '' ) . $mensagem->assunto; ?></td>
            <td><?php echo format_date($mensagem->getCreatedAt(),'d/M/yy'); ?> às <?php echo format_date($mensagem->getCreatedAt(),'HH:mm:ss'); ?></td>
            <td class="actions">
                <?php echo link_to(__('Visualizar'),'@mensagem_view?id=' . $mensagem->id, array('class' => 'list_view'));?>
                <?php //echo link_to(__('Excluir'),'@mensagem_delete?id=' . $mensagem->id, array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
    include_partial('global/pager',array(
        'pager' => $pager,
    ));
?>