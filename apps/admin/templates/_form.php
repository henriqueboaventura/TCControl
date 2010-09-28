<?php
    include_partial('global/message',array('sf_user',$sf_user));    
    
    if(isset($action)){
        $url = $action;
    } else {
        if($form->getObject()->isNew()){
            $url = 'create';
        } else {
            $url = 'update?id=' . $form->getObject()->getId();
        }
    }
?>
<form action="<?php echo url_for($module . '/'. $url); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" '; ?>>
    <fieldset>
        <?php if (method_exists($form, 'getObject') AND !$form->getObject()->isNew()): ?>
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
            <?php echo (isset($back_list) AND $back_list == false) ? '' : link_to(__('Voltar para a lista'), url_for($module . '/index')); ?>
            <input type="submit" value="<?php echo __('Enviar');?>" class="button" />            
        </span>
    </fieldset>
</form>
