<h2><?php echo __('Professor');?></h2>
<h3><?php echo __('Listagem');?></h3>
<?php echo link_to(__('Novo'),url_for('aluno/new'));?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Matricula</th>
            <th>Coordenador</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($professors as $professor): ?>
        <tr>
            <td><?php echo $professor->getNome() ?></td>
            <td><?php echo $professor->getEmail() ?></td>
            <td><?php echo $professor->getMatricula() ?></td>
            <td><?php echo ($professor->getCoordenador()) ? 'Sim' : 'Não' ?></td>
            <td>
                <?php echo link_to(__('Alterar'),'professor/edit?id=' . $professor->getId(), array('class' => 'user_edit'));?>
                <?php echo link_to(__('Excluir'),'professor/edit?id=' . $professor->getId(), array('class' => 'user_delete'));?>
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
