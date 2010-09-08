<h2>Perfil</h2>
<h3>Alterar Senha</h3>
<?php
    if($sf_user->getFlash('error') != '' OR $sf_user->getFlash('success') != ''){
        printf('<p class="%s">%s</p>',($sf_user->hasFlash('error') ? 'error' : 'success') ,($sf_user->getFlash('error') ?: $sf_user->getFlash('success')));
    }
?>
<form action="<?php echo url_for('profile/senha'); ?>" method="post">
    <fieldset>
        <input type="hidden" name="sf_method" value="put" />
        <?php
            echo $form->renderHiddenFields();
            echo $form['senha_atual']->renderLabel();
            echo $form['senha_atual']->render(array('class' => ($form['senha_atual']->hasError()) ? 'field_error' : ''));
            echo $form['senha_atual']->renderError();
            echo $form['nova_senha']->renderLabel();
            echo $form['nova_senha']->render(array('class' => ($form['nova_senha']->hasError()) ? 'field_error' : ''));
            echo $form['nova_senha']->renderError();
            echo $form['confirmar_senha']->renderLabel();
            echo $form['confirmar_senha']->render(array('class' => ($form['confirmar_senha']->hasError()) ? 'field_error' : ''));
            echo $form['confirmar_senha']->renderError();
            
        ?>
        <input type="submit" class="button" value="Enviar" />
    </fieldset>
</form>