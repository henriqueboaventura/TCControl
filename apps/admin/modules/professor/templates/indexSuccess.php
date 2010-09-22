<h2><?php echo __('Professor');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('professor/new'));?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Matricula</th>
            <th>Coordenador</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($professors as $professor): ?>
        <tr>
            <td><?php echo $professor->getNome() ?></td>
            <td><?php echo $professor->getEmail() ?></td>
            <td><?php echo $professor->getMatricula() ?></td>
            <td><?php echo !is_null($professor->Curso->id) ? 'Sim' : 'Não' ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'professor/edit?id=' . $professor->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'professor/delete?id=' . $professor->getId(), array('class' => 'user_delete'));?>
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
