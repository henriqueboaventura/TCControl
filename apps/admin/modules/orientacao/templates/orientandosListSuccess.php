<h2>Orientandos</h2>
<h3>Listagem</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Nome</th>            
            <th>Status</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $aluno): ?>
        <tr>
            <td><?php echo $aluno->getNome() ?></td>
            <!-- FIX ME -->            
            <td><?php echo $aluno->Orientacao[0]->getStatusDescricao();?></td>
            <td class="actions">
                <?php
                    if($showActions){
                        echo link_to(__('Aceitar Orientação'),'@orientacao_action?aluno_id=' . $aluno->getId() . '&acao=aceitar', array('class' => 'user_orientacao_accept', 'title' => 'Aceitar Orientação'));
                        echo link_to(__('Rejeitar Orientação'),'@orientacao_action?aluno_id=' . $aluno->getId()  . '&acao=rejeitar', array('class' => 'user_orientacao_deny', 'title' => 'Rejeitar Orientação'));
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
