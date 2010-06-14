<h1><?php echo __('Lista de Alunos');?></h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Matricula</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($alunos as $aluno): ?>
    <tr>
      <td><a href="<?php echo url_for('aluno/edit?id='.$aluno->getId()) ?>"><?php echo $aluno->getId() ?></a></td>
      <td><?php echo $aluno->getNome() ?></td>
      <td><?php echo $aluno->getEmail() ?></td>
      <td><?php echo $aluno->getMatricula() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo link_to(__('Novo'),url_for('aluno/new'));?>
