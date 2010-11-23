<h2>Relatório</h2>
<h3>Orientador Alunos</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Orientador</th>
            <th>Alunos</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($registros as $professor): ?>
        <tr>
            <td><?php echo $professor->nome; ?></td>
            <td>
                <ol>
                    <?php foreach($professor->Orientandos as $orientando): ?>
                    <li><?php echo $orientando->nome . ' - ' . (($orientando->Etapas[1]->etapa) ? 'TCC 2' : 'TCC 1'); ?></li>
                    <?php endforeach; ?>
                </ol>
                <?php //echo $proposta->titulo; ?>
            </td>
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
