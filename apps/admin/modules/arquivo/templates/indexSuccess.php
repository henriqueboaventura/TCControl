<?php use_helper('Date'); ?>
<h2><?php echo __('Arquivo');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('arquivo/new'),array('class' => 'new_register'));?>
<table>
    <thead>
        <tr>
            <th><?php echo __('Nome');?></th>
            <th><?php echo __('Tipo');?></th>
            <th><?php echo __('Dono');?></th>
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
    <?php foreach ($arquivos as $arquivo): ?>
        <tr>
            <td><?php echo $arquivo->getNome() ?></td>
            <td><?php echo $arquivo->getTipoFormatted() ?></td>
            <td><?php echo $arquivo->Remetente->getNome() ?></td>
            <td><?php echo format_date($arquivo->getCreatedAt(),'d/M/yy'); ?> às <?php echo format_date($arquivo->getCreatedAt(),'HH:mm:ss'); ?></td>
            <td class="actions">
                <?php echo link_to(__('Download'),'/uploads/arquivo/' . $arquivo->getPath(), array('class' => 'list_document'));?>
                <?php echo ($arquivo->Remetente->id == $sf_user->getAttribute('id', null, 'usuario')) ? link_to(__('Alterar'),'arquivo/edit?id=' . $arquivo->getId(), array('class' => 'list_edit')) : '';?>
                <?php echo link_to(__('Excluir'),'arquivo/delete?id=' . $arquivo->getId(), array('class' => 'list_delete delete'));?>
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
