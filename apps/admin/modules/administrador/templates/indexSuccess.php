<h2><?php echo __('Administrador');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php
if($sf_user->getFlash('error') != '' OR $sf_user->getFlash('success') != ''){
    printf('<p class="%s">%s</p>',($sf_user->hasFlash('error') ? 'error' : 'success') ,($sf_user->getFlash('error') ?: $sf_user->getFlash('success')));
}
?>
<?php echo link_to(__('Novo'),url_for('administrador/new'));?>
<table>
    <thead>
        <tr>
            <th><?php echo __('Nome');?></th>
            <th><?php echo __('E-mail');?></th>
            <th><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="3" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($administradors as $administrador): ?>
        <tr>
            <td><?php echo $administrador->getNome() ?></td>
            <td><?php echo $administrador->getEmail() ?></td>
            <td>
                <?php echo link_to(__('Alterar'),'administrador/edit?id=' . $administrador->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'administrador/delete?id=' . $administrador->getId(), array('class' => 'user_delete'));?>
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
