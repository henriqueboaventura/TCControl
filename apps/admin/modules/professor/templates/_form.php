<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('professor/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<?php echo link_to(__('Voltar para a lista'), url_for('professor/index')); ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to(__('Excluir'), 'professor/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' =>  __('Você tem certeza?'))) ?>
          <?php endif; ?>
          <input type="submit" value="<?php echo __('Salvar');?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['nome']->renderLabel() ?></th>
        <td>
          <?php echo $form['nome']->renderError() ?>
          <?php echo $form['nome'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['email']->renderLabel() ?></th>
        <td>
          <?php echo $form['email']->renderError() ?>
          <?php echo $form['email'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['senha']->renderLabel() ?></th>
        <td>
          <?php echo $form['senha']->renderError() ?>
          <?php echo $form['senha'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['matricula']->renderLabel() ?></th>
        <td>
          <?php echo $form['matricula']->renderError() ?>
          <?php echo $form['matricula'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['endereco']->renderLabel() ?></th>
        <td>
          <?php echo $form['endereco']->renderError() ?>
          <?php echo $form['endereco'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fone_residencial']->renderLabel() ?></th>
        <td>
          <?php echo $form['fone_residencial']->renderError() ?>
          <?php echo $form['fone_residencial'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fone_celular']->renderLabel() ?></th>
        <td>
          <?php echo $form['fone_celular']->renderError() ?>
          <?php echo $form['fone_celular'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['coordenador']->renderLabel() ?></th>
        <td>
          <?php echo $form['coordenador']->renderError() ?>
          <?php echo $form['coordenador'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['areas_afinidade_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['areas_afinidade_list']->renderError() ?>
          <?php echo $form['areas_afinidade_list'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
