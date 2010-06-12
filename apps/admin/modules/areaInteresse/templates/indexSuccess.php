<h1>Area interesses List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Professor</th>
      <th>Nome</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($area_interesses as $area_interesse): ?>
    <tr>
      <td><a href="<?php echo url_for('areaInteresse/edit?id='.$area_interesse->getId()) ?>"><?php echo $area_interesse->getId() ?></a></td>
      <td><?php echo $area_interesse->getProfessor() ?></td>
      <td><?php echo $area_interesse->getNome() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('areaInteresse/new') ?>">New</a>
