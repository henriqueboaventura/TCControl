<h2>Relatório</h2>
<h3>Propostas</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Titulo</th>
            <th>Avaliação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registros as $proposta): ?>
        <tr>
            <td><?php echo $proposta->Aluno->nome; ?></td>
            <td><?php echo $proposta->titulo; ?></td>
            <td><?php echo ($proposta->Avaliacao) ? (($proposta->Avaliacao->aprovada) ? 'Aprovada' : 'Reprovada') : 'Aguardando';?></td>
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
