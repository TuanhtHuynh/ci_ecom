<table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ( $categories as $key => $value ) {?>
    <?php echo '<tr>
        <td>' . $value->Id . '</td>
        <td> ' . $value->Name . ' </td>
        <td></td>
      </tr>'; ?>
    <?php }?>

  </tbody>
</table>