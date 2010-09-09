<h2><?php echo __('Administrador');?></h2>
<h3><?php echo __('Listagem');?></h3>
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
                <?php echo link_to(__('Excluir'),'administrador/edit?id=' . $administrador->getId(), array('class' => 'user_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
    if($pager->haveToPaginate()){
?>
<div class="pagination">
    <a href="<?php echo url_for('administrador/index?page=1');?>">
        <img src="/images/first.png" alt="<?php echo __('Primeira página');?>" title="<?php echo __('Primeira página');?>" />
    </a>
    <a href="<?php echo url_for('administrador/index?page=' . $pager->getPreviousPage() )?>">
        <img src="/images/previous.png" title="<?php echo __('Página anterior');?>" title="<?php echo __('Página anterior');?>" />
    </a>
    <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
    <span class="unlinkedPage"><?php echo $page ?></span>
    <?php else: ?>
    <a href="<?php echo url_for('administrador/index?page=' . $page)?>"><?php echo $page ?></a>
    <?php endif; ?>
    <?php endforeach; ?>
    <a href="<?php echo url_for('administrador/index?page=' . $pager->getNextPage() ) ; ?>">
        <img src="/images/next.png" alt="<?php echo __('Próxima Página');?>" title="<?php echo __('Próxima Página');?>" />
    </a>
    <a href="<?php echo url_for('administrador/index?page=' . $pager->getLastPage()) ?>">
        <img src="/images/last.png" alt="<?php echo __('Última página');?>" alt="<?php echo __('Última página');?>" />
    </a>
    
</div>
<?php
    }
?>