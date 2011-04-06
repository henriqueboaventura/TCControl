<h2>Documento</h2>
<h3>Listagem</h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <?php if($sf_user->getAttribute('coordenador', false, 'professor')) : ?>
            <th>Orientador</th>
            <?php endif; ?>
            <th>Titulo</th>
            <th>Status</th>
            <th class="actions">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artigos as $artigo): ?>
        <tr>
            <td><?php echo $artigo->Aluno->getNome() ?></td>
            <?php if($sf_user->getAttribute('coordenador', false, 'professor')) : ?>
            <td><?php echo $artigo->Aluno->Orientador[0]->nome; ?></td>
            <?php endif; ?>
            <td><?php echo $artigo->Aluno->Proposta->titulo;?></td>
            <td><?php echo $artigo->getStatusDescricao();?></td>
            <td class="actions">
                <?php
                    echo link_to(__('Visualizar Documento'), '@artigo_view?id=' . $artigo->getId(),array('class' => 'list_view', 'title' => 'Visualizar'));
                    if($coordenador){
                        //echo link_to(__('Aprovar Proposta'),'@artigo_action?id=' . $artigo->getId() . '&acao=aceitar', array('class' => 'list_accept', 'title' => 'Aprovar Proposta'));
                        //echo link_to(__('Rejeitar Proposta'),'@artigo_action?id=' . $artigo->getId()  . '&acao=rejeitar', array('class' => 'list_deny', 'title' => 'Rejeitar Proposta'));
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
        'action' => 'list?filtro=' . $sf_request->getParameter('filtro')
    ));
?>
