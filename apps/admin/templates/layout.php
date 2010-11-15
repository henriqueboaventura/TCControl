<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div class="container">
            <header class="span-24 clear">
                <h1><?php echo link_to(image_tag('/images/logo.png',array('alt'=>'TCCtrl')),'@home');?></h1>
                <small>Sistema de Controle e Gerenciamento de <span>TCC</span></small>
            </header>
            <div id="content" class="span-24">
            <?php echo $sf_content ?>
            </div>
            <footer class="clear">Desenvolvido por Henrique Boaventura</footer>
        </div>
    </body>
</html>
