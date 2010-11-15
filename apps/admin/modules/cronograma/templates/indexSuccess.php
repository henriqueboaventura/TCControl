<?php use_helper('Date'); ?>
<h2><?php echo __('Cronograma');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('cronograma/new'),array('class' => 'new_register'));?>
<table>
    <caption>TCC <span>1</span></caption>
    <thead>
        <tr>
            <th><?php echo __('Atividade');?></th>
            <th><?php echo __('Produto');?></th>
            <th><?php echo __('Entrega');?></th>
            <th><?php echo __('Detalhamento');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cronogramasTCC1 as $cronograma): ?>
        <tr>
            <td><?php echo $cronograma->getAtividade() ?></td>
            <td><?php echo $cronograma->getProduto() ?></td>
            <td><?php echo format_date($cronograma->getDataEntrega(),'dd/MM/yy'); ?></td>
            <td><?php echo $cronograma->getDetalhamento() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'cronograma/edit?id=' . $cronograma->getId(), array('class' => 'list_edit'));?>
                <?php echo link_to(__('Excluir'),'cronograma/delete?id=' . $cronograma->getId(), array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<table>
    <caption>TCC <span>2</span></caption>
    <thead>
        <tr>
            <th><?php echo __('Atividade');?></th>
            <th><?php echo __('Produto');?></th>
            <th><?php echo __('Entrega');?></th>
            <th><?php echo __('Detalhamento');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cronogramasTCC2 as $cronograma): ?>
        <tr>
            <td><?php echo $cronograma->getAtividade() ?></td>
            <td><?php echo $cronograma->getProduto() ?></td>
            <td><?php echo format_date($cronograma->getDataEntrega(),'dd/MM/yy'); ?></td>
            <td><?php echo $cronograma->getDetalhamento() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'cronograma/edit?id=' . $cronograma->getId(), array('class' => 'list_edit'));?>
                <?php echo link_to(__('Excluir'),'cronograma/delete?id=' . $cronograma->getId(), array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
