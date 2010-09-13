<h2>Orientandos</h2>
<h3>Listagem</h3>
<?php
if($sf_user->getFlash('error') != '' OR $sf_user->getFlash('success') != ''){
    printf('<p class="%s">%s</p>',($sf_user->hasFlash('error') ? 'error' : 'success') ,($sf_user->getFlash('error') ?: $sf_user->getFlash('success')));
}
?>
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
                <?php echo link_to(__('Aceitar Orientação'),'@orientacao_action?aluno_id=' . $aluno->getId() . '&acao=aceitar', array('class' => 'user_orientacao_accept', 'title' => 'Aceitar Orientação'));?>
                <?php echo link_to(__('Rejeitar Orientação'),'@orientacao_action?aluno_id=' . $aluno->getId()  . '&acao=rejeitar', array('class' => 'user_orientacao_deny', 'title' => 'Rejeitar Orientação'));?>                
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
