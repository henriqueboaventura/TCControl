<h2><?php echo __('Plano de Trabalho');?></h2>
<h3><?php echo __('Definir Proposta');?></h3>
<?php
    include_partial('global/message',array('sf_user',$sf_user));    
?>
<form action="<?php echo url_for('proposta/edit'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" '; ?>>
    <fieldset>
        <?php if (method_exists($form, 'getObject') AND !$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
        <?php 
            endif;
            
            foreach($form as $nome => $field){                
                if(!$field->isHidden()){
                    echo $field->renderLabel();
                    if(array_key_exists($nome, $comentarios)){
                        echo link_to(
                            'Ver Comentários (' . count($comentarios[$nome]) . ')', 
                            '@proposta_view_comment?proposta_id=' . $proposta->id . '&local=' . $nome,
                            array(
                                'class' => 'comment_view',
                                'title' => 'Ver Comentários (' . count($comentarios[$nome]) . ')'
                            )
                        );
                    }
                    echo $field->render(array('class' => ($field->hasError()) ? 'field_error' : ''));
                    echo $field->renderError();
                }
            }
            echo $form->renderHiddenFields(false);
        ?>
        <span id="actions_bar">            
            <input type="submit" value="<?php echo __('Salvar');?>" class="button" />
            <?php echo link_to('Enviar para avaliação','@proposta_avaliacao?id=' . $proposta->id);?>
        </span>
    </fieldset>
</form>

