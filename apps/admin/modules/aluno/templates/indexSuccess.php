<h1>Alunos List</h1>

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
    </tr>
  </thead>
  <tbody>
    <?php foreach ($alunos as $aluno): ?>
    <tr>
      <td><a href="<?php echo url_for('aluno/edit?id='.$aluno->getId()) ?>"><?php echo $aluno->getId() ?></a></td>
      <td><?php echo $aluno->getNome() ?></td>
      <td><?php echo $aluno->getEmail() ?></td>
      <td><?php echo $aluno->getSenha() ?></td>
      <td><?php echo $aluno->getMatricula() ?></td>
      <td><?php echo $aluno->getEndereco() ?></td>
      <td><?php echo $aluno->getFoneResidencial() ?></td>
      <td><?php echo $aluno->getFoneCelular() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('aluno/new') ?>">New</a>
