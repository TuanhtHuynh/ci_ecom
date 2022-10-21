<?php $this->load->view( 'admin/header/header' );?>
<?php $this->load->view( 'admin/header/main_container' )?>

<!-- message -->
<?php if ( isset( $_SESSION['updated'] ) ): ?>
<?php if ( $_SESSION['updated'] == 'yes' ): ?>
<div class="alert alert-success" role="alert">
  <strong>đã cập nhật thông tin</strong>
</div>
<?php elseif ( $_SESSION['updated'] == 'no' ): ?>
<div class="alert alert-danger" role="alert">
  <strong>không thể cập nhật thông tin</strong>
</div>
<?php endif;?>
<?php endif;?>
<!-- /message -->
<!-- thêm category button -->
<div class="d-flex justify-content-between mb-3">
  <div></div>
  <a class="btn btn-primary d-flex align-items-center" href="<?=base_url() . 'admin/category/new_category'?>"
    role="button">
    <i data-feather="plus" class="mr-3"></i>Thêm
    danh
    mục</a>
</div>
<!-- /thêm category button -->

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Tên danh mục</th>
        <th>Actived</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $categories as $key => $value ) {?>
      <?='<tr>
          <td>' . $value->Id . '</td>
          <td>' . $value->Name . '</td>
          <td>' . ( $value->status == '1' ? 'actived' : '<span class="text-danger text-center">deactived</span>' ) . '</td>
          <td>
          <a class="btn btn-warning
           btn-sm mr-3" href="' . base_url() . 'admin/category/edit_category/' . $value->Id . '">
           <i data-feather="edit"></i>
          </a>
          <a type="button" href="#" class="btn delete btn-danger btn-sm" data-id=' . $value->Id . '>
            <i data-feather="trash-2"></i>
          </a>
          </td>
        </tr>'?>
      <?php }?>
    </tbody>
  </table>
</div>
</main>
</div>
</div>
<?php $this->load->view( 'admin/header/footer' );?>
<script type="text/javascript">
$('.delete').click(function() {
  var id = $(this).attr('data-id');
  if (confirm('Bạn có muốn xoá id ' + id + '?')) {
    $.ajax({
      url: '<?=base_url() . 'admin/category/delete_category/'?>' + id,
      type: 'post',
      data: {
        'delete_id': id
      },
      success: function(response) {
        if (response == 'succeed') {
          location.reload();
        } else {
          alert('lỗi xoá danh mục');
        }
      }
    });
  }
});
</script>