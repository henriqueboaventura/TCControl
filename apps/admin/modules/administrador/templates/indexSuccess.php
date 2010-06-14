<h1><?php echo __('Lista de Administradores');?></h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($administradors as $administrador): ?>
    <tr>
      <td><a href="<?php echo url_for('administrador/edit?id='.$administrador->getId()) ?>"><?php echo $administrador->getId() ?></a></td>
      <td><?php echo $administrador->getNome() ?></td>
      <td><?php echo $administrador->getEmail() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo link_to(__('Novo'),url_for('administrador/new'));?>
