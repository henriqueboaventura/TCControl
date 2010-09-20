<h2><?php echo __('Área de Afinidade');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('areaAfinidade/new'));?>
<table>
    <thead>
        <tr>
            <th><?php echo __('Nome');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="3" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($areasAfinidade as $areaAfinidade): ?>
        <tr>
            <td><?php echo $areaAfinidade->getNome() ?></td>
            <td class="actions">
                <?php
                    if($areaAfinidade->Professor[0]->id != false){
                        echo link_to(__('Desvincular'),'@area_afinidade_action?action=desvincular&id=' . $areaAfinidade->getId(), array('class' => 'list_deny', 'title' => 'Desvincular'));
                    } else {
                        echo link_to(__('Vincular'),'@area_afinidade_action?action=vincular&id=' . $areaAfinidade->getId(), array('class' => 'list_accept', 'title' => 'Vincular'));
                    }
                ?>
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
