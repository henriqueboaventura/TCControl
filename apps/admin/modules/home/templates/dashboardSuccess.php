<?php
    use_helper('Date');
    if($aluno):
?>
<div id="proposta_box" class="dashboard_box span-6">
    <h3>Proposta</h3>
    <?php echo link_to('Definir Proposta', '@proposta',array('class' => 'proposta', 'title' => 'Definir Proposta')); ?>
    <?php echo link_to('Definir Cronograma', 'cronograma/index',array('class' => 'cronograma', 'title' => 'Definir Cronograma')); ?>
    <span class="date">Data de entrega: <?php echo format_date($sf_user->getAttribute('data_entrega_tcc1', null, 'configuracao')); ?></span>
</div>
<div id="artigo_box" class="dashboard_box span-6">
    <h3>Documento</h3>
    <?php echo link_to('Definir Documento', '@artigo',array('class' => 'artigo', 'title' => 'Definir Documento')); ?>
    <?php //echo link_to('Comentarios', '@artigo',array('class' => 'artigo')); ?>
    <span class="date">Data de entrega: <?php echo format_date($sf_user->getAttribute('data_entrega_tcc2', null, 'configuracao')); ?></span>
</div>
<div id="orientador_box" class="dashboard_box span-6 last">
    <h3>Orientador</h3>
    <p><?php echo $aluno->Orientacao[0]->Professor->nome; ?></p>
</div>
<?php endif; ?>
<table>
    <caption>Mensagens <span>Caixa de Entrada</span></caption>
    <thead>
        <tr>
            <th><?php echo __('Remetente');?></th>
            <th><?php echo __('Assunto');?></th>
            <th><?php echo __('Data');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5" class="results"><?php echo count($mensagens);?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($mensagens as $mensagem): ?>
        <tr class="<?php echo ($mensagem->lido) ? 'read' : 'unread'; ?>">
            <td><?php echo $mensagem->Remetente->nome; ?></td>
            <td><?php echo ((!is_null($mensagem->Original->id)) ? 'RE:' : '' ) . $mensagem->assunto; ?></td>
            <td><?php echo format_date($mensagem->getCreatedAt(),'d/M/yy'); ?> às <?php echo format_date($mensagem->getCreatedAt(),'HH:mm:ss'); ?></td>
            <td class="actions">
                <?php echo link_to(__('Visualizar'),'@mensagem_view?id=' . $mensagem->id, array('class' => 'list_view'));?>
                <?php //echo link_to(__('Excluir'),'@mensagem_delete?id=' . $mensagem->id, array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<table>
    <caption>Arquivos <span>Recebidos</span></caption>
    <thead>
        <tr>
            <th><?php echo __('Nome');?></th>
            <th><?php echo __('Tipo');?></th>
            <th><?php echo __('Dono');?></th>
            <th><?php echo __('Data');?></th>
            <th class="actions"><?php echo __('Ações');?></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="5" class="results"><?php echo count($arquivos);?> <?php echo __('registro(s)');?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($arquivos as $arquivo): ?>
        <tr>
            <td><?php echo $arquivo->getNome() ?></td>
            <td><?php echo $arquivo->getTipoFormatted() ?></td>
            <td><?php echo $arquivo->Remetente->getNome() ?></td>
            <td><?php echo format_date($arquivo->getCreatedAt(),'d/M/yy'); ?> às <?php echo format_date($arquivo->getCreatedAt(),'HH:mm:ss'); ?></td>
            <td class="actions">
                <?php echo link_to(__('Download'),'/uploads/arquivo/' . $arquivo->getPath(), array('class' => 'list_document'));?>
                <?php echo ($arquivo->Remetente->id == $sf_user->getAttribute('id', null, 'usuario')) ? link_to(__('Alterar'),'arquivo/edit?id=' . $arquivo->getId(), array('class' => 'list_edit')) : '';?>
                <?php echo link_to(__('Excluir'),'arquivo/delete?id=' . $arquivo->getId(), array('class' => 'list_delete'));?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>