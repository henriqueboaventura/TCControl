<h1>Administradors List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Senha</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($administradors as $administrador): ?>
    <tr>
      <td><a href="<?php echo url_for('administrador/edit?id='.$administrador->getId()) ?>"><?php echo $administrador->getId() ?></a></td>
      <td><?php echo $administrador->getNome() ?></td>
      <td><?php echo $administrador->getEmail() ?></td>
      <td><?php echo $administrador->getSenha() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('administrador/new') ?>">New</a>
