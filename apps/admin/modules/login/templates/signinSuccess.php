<form action="<?php echo url_for('@signin');?>" id="login" class="span-24" method="post">
    <fieldset class="span-6">
        <legend>Login</legend>
        <?php echo (sfContext::getInstance()->getUser()->hasFlash("error")) ? "<p class='error'>".sfContext::getInstance()->getUser()->getFlash("error")."</p>" : "";?>
        <?php
            echo $form['email']->renderLabel();
            echo $form['email']->render();
            echo $form['senha']->renderLabel();
            echo $form['senha']->render();
            echo $form['_csrf_token']->render();
        ?>
    <input type="submit" value="Login" class="button" />
    </fieldset>
</form>
