<h2><?php echo __('Cronograma');?></h2>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<h3><?php echo __('Listagem');?></h3>
<?php echo link_to(__('Novo'),url_for('cronograma/new'));?>
<h4>TCC 1</h4>
<table>
    <thead>
        <tr>
            <th><?php echo __('Atividade');?></th>
            <th><?php echo __('Produto');?></th>
            <th><?php echo __('Data de Entrega');?></th>
            <th><?php echo __('Detalhamento');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cronogramas as $cronograma): ?>
        <tr>
            <td><?php echo $cronograma->getNome() ?></td>
            <td><?php echo $cronograma->getEmail() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'administrador/edit?id=' . $cronograma->getId(), array('class' => 'list_edit'));?>
                <?php echo link_to(__('Excluir'),'administrador/delete?id=' . $cronograma->getId(), array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h4>TCC 2</h4>
<table>
    <thead>
        <tr>
            <th><?php echo __('Atividade');?></th>
            <th><?php echo __('Produto');?></th>
            <th><?php echo __('Data de Entrega');?></th>
            <th><?php echo __('Detalhamento');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cronogramas as $cronograma): ?>
        <tr>
            <td><?php echo $cronograma->getNome() ?></td>
            <td><?php echo $cronograma->getEmail() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'administrador/edit?id=' . $cronograma->getId(), array('class' => 'list_edit'));?>
                <?php echo link_to(__('Excluir'),'administrador/delete?id=' . $cronograma->getId(), array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
