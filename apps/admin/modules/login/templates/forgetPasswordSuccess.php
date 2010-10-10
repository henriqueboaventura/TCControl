<p>Para solicitar uma nova senha, preencha os dados abaixo. A nova senha será enviada para o seu e-mail</p>
<form action="<?php echo url_for('@forget_password');?>" id="login" class="span-24" method="post">
    <fieldset class="span-6">
        <legend>Esqueci a senha</legend>
        <?php echo (sfContext::getInstance()->getUser()->hasFlash("error")) ? "<p class='error'>".sfContext::getInstance()->getUser()->getFlash("error")."</p>" : "";?>
        <?php
            echo $form['email']->renderLabel();
            echo $form['email']->renderError();
            echo $form['email']->render();
            echo $form['matricula']->renderLabel();
            echo $form['matricula']->renderError();
            echo $form['matricula']->render();
            echo $form['_csrf_token']->render();
        ?>
    <input type="submit" value="Enviar" class="button" />
    </fieldset>
</form>
