<h2>Relatório</h2>
<h3>Alunos Matriculados</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Etapa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registros as $aluno): ?>
        <tr>
            <td><?php echo $aluno->nome; ?></td>
            <td><?php echo 'TCC' . (($aluno->Etapas[1]->etapa) ? 2 : 1);?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
    include_partial('global/pager',array(
        'pager' => $pager,
        'action' => 'index?tipo=' . $sf_request->getParameter('tipo')
    ));
?>
