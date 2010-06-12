<h1>Area afinidades List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>Slug</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($area_afinidades as $area_afinidade): ?>
    <tr>
      <td><a href="<?php echo url_for('areaAfinidade/edit?id='.$area_afinidade->getId()) ?>"><?php echo $area_afinidade->getId() ?></a></td>
      <td><?php echo $area_afinidade->getNome() ?></td>
      <td><?php echo $area_afinidade->getSlug() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('areaAfinidade/new') ?>">New</a>
