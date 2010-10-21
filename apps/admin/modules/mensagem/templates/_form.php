<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('mensagem/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('mensagem/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'mensagem/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['remetente_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['remetente_id']->renderError() ?>
          <?php echo $form['remetente_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['destinatario_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['destinatario_id']->renderError() ?>
          <?php echo $form['destinatario_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['original_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['original_id']->renderError() ?>
          <?php echo $form['original_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['assunto']->renderLabel() ?></th>
        <td>
          <?php echo $form['assunto']->renderError() ?>
          <?php echo $form['assunto'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['conteudo']->renderLabel() ?></th>
        <td>
          <?php echo $form['conteudo']->renderError() ?>
          <?php echo $form['conteudo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['lido']->renderLabel() ?></th>
        <td>
          <?php echo $form['lido']->renderError() ?>
          <?php echo $form['lido'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
