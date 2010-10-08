<h2><?php echo __('Artigos');?></h2>
<h3><?php echo __('Histórico de Versões');?></h3>
<ol id="versions">
    <?php foreach($versoes as $versao): ?>
    <li class="<?php echo ($versao->version == $artigo->version) ? 'selected' : '';?>"><?php echo link_to(sprintf('<strong>Versão %s</strong> - Alterada em: <em>%s</em>',$versao->version, format_date($versao->updated_at,'f')),'@home'); ?></li>
    <?php endforeach; ?>
</ol>
<hr />
<?php echo $diff; ?>