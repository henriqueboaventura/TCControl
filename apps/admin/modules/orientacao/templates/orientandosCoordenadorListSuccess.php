<h2>Orientandos</h2>
<h3>Aguardando Aprovação</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Professor</th>
            <th>Nome</th>            
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orientacoes as $orientacao): ?>
        <tr>            
            <td><?php echo $orientacao->Professor->nome; ?></td>            
            <td><?php echo $orientacao->Aluno->nome;?></td>
            <td class="actions">
            <?php                    
                echo link_to(__('Aceitar Orientação'),'@orientacao_action?professor_id=' . $orientacao->Professor->id . '&aluno_id=' . $orientacao->Aluno->id . '&acao=aceitar', array('class' => 'user_orientacao_accept', 'title' => 'Aceitar Orientação'));
                echo link_to(__('Rejeitar Orientação'),'@orientacao_action?professor_id=' . $orientacao->Professor->id . '&aluno_id=' . $orientacao->Aluno->id  . '&acao=rejeitar', array('class' => 'user_orientacao_deny', 'title' => 'Rejeitar Orientação'));                    
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
