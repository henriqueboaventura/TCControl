<h2><?php echo __('Aluno');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<?php echo link_to(__('Novo'),url_for('aluno/new'));?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Matricula</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="4" class="results"><?php echo $pager->getNbResults();?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?php echo $aluno->getNome() ?></td>
            <td><?php echo $aluno->getEmail() ?></td>
            <td><?php echo $aluno->getMatricula() ?></td>
            <td class="actions">
                <?php echo link_to(__('Alterar'),'aluno/edit?id=' . $aluno->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'aluno/delete?id=' . $aluno->getId(), array('class' => 'user_delete'));?>
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
