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
            <header class="clear">
                <h1><?php echo link_to('TCCtrl','@home');?></h1>
                <small>Sistema de Controle e Gerenciamento de TCC</small>
                <div id="tool_box">
                    Olá, <span class="name"><?php echo $sf_user->getAttribute('nome','John Doe','usuario');?></span>
                    <?php echo image_tag('/images/cog.png');?>
                    <ul>
                        <li><?php echo link_to('Alterar Dados Pessoais','profile/atualizar');?></li>
                        <li><?php echo link_to('Alterar Senha','profile/senha');?></li>
                        <li><?php echo link_to('Preferências','@homepage');?></li>
                        <li><?php echo link_to('Sair','@signout');?></li>
                    </ul>
                </div>
            </header>
            <div id="nav_menu" class="span-5">
            <?php include_component('home','menu'); ?>
            </div>
            <div id="content" class="span-19 <?php echo $sf_context->getModuleName(); ?> last">
            <?php echo $sf_content ?>
            </div>
            <footer class="clear">Desenvolvido por Henrique Boaventura</footer>
        </div>
    </body>
</html>
