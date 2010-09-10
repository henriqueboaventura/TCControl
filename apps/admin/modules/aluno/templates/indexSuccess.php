<h2><?php echo __('Aluno');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php echo link_to(__('Novo'),url_for('aluno/new'));?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Matricula</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?php echo $aluno->getNome() ?></td>
            <td><?php echo $aluno->getEmail() ?></td>
            <td><?php echo $aluno->getMatricula() ?></td>
            <td>
                <?php echo link_to(__('Alterar'),'aluno/edit?id=' . $aluno->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'aluno/edit?id=' . $aluno->getId(), array('class' => 'user_delete'));?>
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
