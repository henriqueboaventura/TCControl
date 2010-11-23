<?php use_helper('Date');?>
<h2>Relatório</h2>
<h3>Horário das Bancas</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Banca</th>
            <th>Resultado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registros as $aluno): ?>
        <tr>
            <td><?php echo $aluno->nome; ?></td>
            <td>
                <ol>
                    <li><?php echo $aluno->Banca[0]->Avaliador1->nome; ?></li>
                    <li><?php echo $aluno->Banca[0]->Avaliador2->nome; ?></li>
                    <li><?php echo $aluno->Banca[0]->Avaliador3->nome; ?></li>
                </ol>
            </td>
            <td><?php echo ($aluno->Banca[0]->Avaliacao) ? $aluno->Banca[0]->Avaliacao->avaliacaoGeral : 'Aguardando'; ?></td>
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
