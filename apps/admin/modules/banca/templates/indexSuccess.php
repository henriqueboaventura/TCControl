<h2><?php echo __('Banca');?></h2>
<h3><?php echo ($avaliacao) ? __('Aguardando Avaliação') : __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo ($avaliacao) ? '' : link_to(__('Nova'),url_for('banca/new'));?>
<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Avaliadores</th>
            <th>Data</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="4" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($bancas as $banca): ?>
        <tr>
            <td><?php echo $banca->Aluno->nome ?></td>
            <td>
                <ul>
                    <li><?php echo $banca->Avaliador1->nome ?></li>
                    <li><?php echo $banca->Avaliador2->nome ?></li>
                </ul>

            </td>
            <td><?php echo format_date($banca->data_banca,'dd/MM/yy HH:mm'); ?></td>
            <td class="actions">
                <?php
                    if($avaliacao){
                        echo link_to(__('Avaliar'),'banca/avaliar?id=' . $banca->id, array('class' => 'list_rate'));
                    } else {
                        echo link_to(__('Alterar'),'banca/edit?id=' . $banca->id, array('class' => 'list_edit'));
                        echo link_to(__('Excluir'),'banca/delete?id=' . $banca->id, array('class' => 'list_delete'));
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
