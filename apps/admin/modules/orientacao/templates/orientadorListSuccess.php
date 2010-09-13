<h2>Orientador</h2>
<h3>Listagem</h3>
<p>Os professores em destaque já atingiram o limite máximo de orientandos. A orientação necessita de aprovação do Coordenador do curso.</p>
<?php
if($sf_user->getFlash('error') != '' OR $sf_user->getFlash('success') != ''){
    printf('<p class="%s">%s</p>',($sf_user->hasFlash('error') ? 'error' : 'success') ,($sf_user->getFlash('error') ?: $sf_user->getFlash('success')));
}
?>
<table>
    <thead>
        <tr>
            <th>Nome</th>            
            <th>Areas de Afinidade</th>
            <th>Qtde. Orientandos</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($professors as $professor): ?>
        <tr <?php echo ($professor->getOrientacaoCount(true) == $sf_user->getAttribute('alunos_por_professor', 0, 'configuracao')) ? 'class="over_limit"' : ''; ?>>

            <td><?php echo $professor->getNome() ?></td>            
            <td>
                <ul>
                <?php foreach($professor->AreasAfinidade as $areaAfinidade): ?>
                    <li><?php echo $areaAfinidade->nome;?></li>
                <?php endforeach;?>
                </ul>
            </td>
            <td><?php echo $professor->getOrientacaoCount(true) ?></td>
            <td class="actions">
                <?php echo link_to(__('Solicitar Orientação'),'@orientador_solicitar?professor_id=' . $professor->getId(), array('class' => 'user_orientacao', 'title' => 'Solicitar Orientação'));?>
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
