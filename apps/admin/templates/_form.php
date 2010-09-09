<?php
    if($sf_user->getFlash('error') != '' OR $sf_user->getFlash('success') != ''){
        printf('<p class="%s">%s</p>',($sf_user->hasFlash('error') ? 'error' : 'success') ,($sf_user->getFlash('error') ?: $sf_user->getFlash('success')));
    }
?>
<form action="<?php echo url_for('administrador/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <fieldset>
        <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
        <?php 
            endif;
            
            foreach($form as $field){
                if(!$field->isHidden()){
                    echo $field->renderLabel();
                    echo $field->render(array('class' => ($field->hasError()) ? 'field_error' : ''));
                    echo $field->renderError();
                }
            }
            echo $form->renderHiddenFields(false);
        ?>
        <span id="actions_bar">
            <?php echo link_to(__('Voltar para a lista'), url_for($module . '/index')); ?>
            <input type="submit" value="<?php echo __('Enviar');?>" class="button" />            
        </span>
    </fieldset>
</form>
