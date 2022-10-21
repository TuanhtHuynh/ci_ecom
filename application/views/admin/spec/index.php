<!-- header -->
<?php $this->load->view( 'admin/header/header' );?>
<?php $this->load->view( 'admin/header/main_container' )?>

<!-- message -->
<?php if ( isset( $_SESSION['updated'] ) ): ?>
<?php if ( $_SESSION['updated'] == 'yes' ): ?>
<div class="alert alert-success" role="alert">
  <strong><?php echo $_SESSION['updated_msg'] ?></strong>
</div>
<?php elseif ( $_SESSION['updated'] == 'no' ): ?>
<div class="alert alert-danger" role="alert">
  <strong><?php echo $_SESSION['updated_msg'] ?></strong>
</div>
<?php endif;?>
<?php endif;?>
<!-- /message -->
<!-- thêm spec button -->
<div class="d-flex justify-content-between mb-3">
  <div></div>
  <a class="btn btn-primary d-flex align-items-center" href="<?=base_url() . 'admin/spec/addspec'?>" role="button">
    <i data-feather="plus" class="mr-3"></i>Thêm thuộc tính
  </a>
</div>
<!-- /thêm spec button -->

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Loại sp</th>
        <th>Tên spec</th>
        <th>Actived</th>
        <th>Ngày</th>
        <th>Edit</th>
        <th>Giá trị spec</th>
        <th>delete</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $specs as $key => $value ): ?>
      <?php $date = strtotime( $value->created_at );?>
      <?php echo '<tr>
          <td>' . $value->id . '</td>
          <td>' . $value->model_name . '</td>
          <td>' . $value->spec_name . '</td>
          <td>' . ( $value->status == '1' ? 'actived' : '<span class="text-danger text-center">deactived</span>' ) . '</td>
          <td>' . date( 'd/m/Y', $date ) . '</td>
          <td>
          <a class="btn btn-warning btn-sm mr-3 editspec"
          data-id=' . $value->id . '
          href="javascript:void(0)">
            <i data-feather="edit"></i>
          </a>
      </td>
      <td>
        <a class="btn btn-warning
           btn-sm mr-3" href="' . base_url() . 'admin/spec/editspec/' . $value->id . '">
          <i data-feather="edit"></i>
        </a>
      </td>
      <td>
        <a type="button" href="javascript:void(0)" class="btn spec-delete btn-danger btn-sm" data-id=' . $value->id . '>
          <i data-feather="trash-2"></i>
        </a>
      </td>
      </tr>' ?>
      <?php endforeach;?>
    </tbody>
  </table>
  <!-- /table-responsive -->
</div>
<div class="my-3 d-flex">
  <?=$links?>
</div>
</main>
</div>
</div>
<!-- footer -->
<!-- ' . base_url() . 'admin/spec/editspecvalue/' . $value->id . ' -->
<?php $this->load->view( 'admin/header/footer' );?>
<?php $this->load->view( 'admin/spec/edit_spec_modal' );?>
<?php $this->load->view( 'admin/spec/spec_index_jsscript' );?>