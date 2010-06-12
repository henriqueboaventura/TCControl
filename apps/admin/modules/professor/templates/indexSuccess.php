<h1>Professors List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Senha</th>
      <th>Matricula</th>
      <th>Endereco</th>
      <th>Fone residencial</th>
      <th>Fone celular</th>
      <th>Coordenador</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($professors as $professor): ?>
    <tr>
      <td><a href="<?php echo url_for('professor/edit?id='.$professor->getId()) ?>"><?php echo $professor->getId() ?></a></td>
      <td><?php echo $professor->getNome() ?></td>
      <td><?php echo $professor->getEmail() ?></td>
      <td><?php echo $professor->getSenha() ?></td>
      <td><?php echo $professor->getMatricula() ?></td>
      <td><?php echo $professor->getEndereco() ?></td>
      <td><?php echo $professor->getFoneResidencial() ?></td>
      <td><?php echo $professor->getFoneCelular() ?></td>
      <td><?php echo $professor->getCoordenador() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('professor/new') ?>">New</a>
