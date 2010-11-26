<h2>Proposta</h2>
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
        <?php foreach ($propostas as $proposta): ?>
        <tr>
            <td><?php echo $proposta->Aluno->getNome() ?></td>
            <?php if($sf_user->getAttribute('coordenador', false, 'professor')) : ?>
            <td><?php echo $proposta->Aluno->Orientador[0]->nome; ?></td>
            <?php endif; ?>
            <td><?php echo $proposta->getTitulo();?></td>
            <td><?php echo $proposta->getStatusDescricao();?></td>
            <td class="actions">
                <?php
                    if(!$coordenador){
                        echo link_to(__('Visualizar Proposta'), '@proposta_view?id=' . $proposta->getId(),array('class' => 'list_view', 'title' => 'Visualizar'));
                    }
                    if($coordenador AND $sf_request->getParameter('filtro') == 'aguardando'){
                        echo link_to(__('Visualizar Proposta'), '@proposta_avaliacao_view?id=' . $proposta->getId(),array('class' => 'list_view', 'title' => 'Visualizar'));
                        echo link_to(__('Aprovar Proposta'),'@proposta_parecer?id=' . $proposta->getId() . '&acao=aceitar', array('class' => 'list_accept', 'title' => 'Aprovar Proposta'));
                        echo link_to(__('Rejeitar Proposta'),'@proposta_parecer?id=' . $proposta->getId()  . '&acao=rejeitar', array('class' => 'list_deny', 'title' => 'Rejeitar Proposta'));
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
