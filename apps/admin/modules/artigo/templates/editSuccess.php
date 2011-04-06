<h2><?php echo __('Documento');?></h2>
<h3><?php echo ($form->isNew()) ? __('Definir') : __('Versão ') . $artigo->version;?></h3>
<?php
    include_partial('global/message',array('sf_user',$sf_user));    
?>
<form action="<?php echo url_for('artigo/edit'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" '; ?>>
    <fieldset>
        <?php if (method_exists($form, 'getObject') AND !$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
        <?php 
            endif;
            
            foreach($form as $nome => $field){                
                if(!$field->isHidden()){
                    echo $field->renderLabel();
                    echo link_to(
                        'Ver Comentários (' . count($artigo->Comentarios) . ')',
                        '@artigo_view_comment?artigo_id=' . $artigo->id,
                        array(
                            'class' => 'comment_view',
                            'title' => 'Ver Comentários (' . count($artigo->Comentarios) . ')'
                    ));
                }
                echo $field->render(array('class' => ($field->hasError()) ? 'field_error' : ''));
                echo $field->renderError();
            }
            echo $form->renderHiddenFields(false);
        ?>
        <span id="actions_bar">            
            <input type="submit" value="<?php echo __('Enviar');?>" class="button" />            
        </span>
    </fieldset>
</form>
