<h2>Alunos sem Orientador</h2>
<h3>Listagem</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Nome</th>            
            <th>Curso</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?php echo $aluno->getNome() ?></td>
            <!-- FIX ME -->            
            <td><?php echo $aluno->Curso->getNome();?></td>
            <td class="actions">
                <?php echo link_to(__('Escolher Orientador'),'@escolher_orientador?aluno_id=' . $aluno->getId() , array('class' => 'user_orientacao_accept', 'title' => 'Escolher Orientador')); ?>
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
