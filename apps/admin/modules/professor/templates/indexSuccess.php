<h1><?php echo __('Lista de Professores');?></h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Matricula</th>
      <th>Coordenador</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($professors as $professor): ?>
    <tr>
      <td><a href="<?php echo url_for('professor/edit?id='.$professor->getId()) ?>"><?php echo $professor->getId() ?></a></td>
      <td><?php echo $professor->getNome() ?></td>
      <td><?php echo $professor->getEmail() ?></td>
      <td><?php echo $professor->getMatricula() ?></td>
      <td><?php echo ($professor->getCoordenador()) ? 'Sim' : 'Não' ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php echo link_to(__('Novo'),url_for('professor/new'));?>
