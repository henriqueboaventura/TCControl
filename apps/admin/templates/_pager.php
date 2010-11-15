<?php
    if($pager->haveToPaginate()){
        $url = $sf_context->getModuleName();
        $url.= '/' . (isset($action) ? $action : 'index?');
?>
<div class="pagination">
    <a href="<?php echo url_for($url . '&page=1');?>">
        <img src="/images/first.png" alt="<?php echo __('Primeira página');?>" title="<?php echo __('Primeira página');?>" />
    </a>
    <a href="<?php echo url_for($url . '&page=' . $pager->getPreviousPage() )?>">
        <img src="/images/previous.png" title="<?php echo __('Página anterior');?>" title="<?php echo __('Página anterior');?>" />
    </a>
    <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
    <span class="unlinkedPage"><?php echo $page ?></span>
    <?php else: ?>
    <a href="<?php echo url_for($url . '&page=' . $page)?>"><?php echo $page ?></a>
    <?php endif; ?>
    <?php endforeach; ?>
    <a href="<?php echo url_for($url . '&page=' . $pager->getNextPage() ) ; ?>">
        <img src="/images/next.png" alt="<?php echo __('Próxima Página');?>" title="<?php echo __('Próxima Página');?>" />
    </a>
    <a href="<?php echo url_for($url . '&page=' . $pager->getLastPage()) ?>">
        <img src="/images/last.png" alt="<?php echo __('Última página');?>" alt="<?php echo __('Última página');?>" />
    </a>    
</div>
<?php
    }
?>
