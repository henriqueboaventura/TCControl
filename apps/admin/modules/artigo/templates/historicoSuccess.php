<h2><?php echo __('Documentos');?></h2>
<h3><?php echo __('Histórico de Versões');?></h3>
<?php include_partial('global/message',array('sf_user',$sf_user)); ?>
<ol id="versions">
    <?php 
        foreach($versoes as $versao):
            $class = '';
            if($versao->version == $artigo->version){
                $class = 'selected';
            } else if($versao->version == $artigo->version - 1){
                $class = 'selected_next';
            }
    ?>
    <li class="<?php echo $class;?>">
        <strong>Versão <?php echo $versao->version; ?></strong> -
        <?php echo link_to(sprintf('Alterada em: <em>%s</em>', format_date($versao->updated_at,'f')),'@artigo_history?versao=' . $versao->version); ?>
        <?php echo link_to('(Voltar para versão)', '@artigo_history_back?versao=' . $versao->version, array('class' => 'voltar_versao'));?>
    </li>
    <?php endforeach; ?>
</ol>
<hr />
<?php echo ($diff != '') ? htmlspecialchars_decode($diff) : $versaoInicial->conteudo; ?>