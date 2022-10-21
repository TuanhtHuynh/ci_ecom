<?php $this->load->view( 'admin/header/header' );?>
<?php $this->load->view( 'admin/header/main_container' )?>

<!-- message -->
<?php if ( isset( $_SESSION['inserted'] ) ): ?>

<?php if ( $_SESSION['inserted'] == 'yes' ): ?>
<div class="alert alert-success" role="alert">
  <strong><?=$_SESSION['inserted_msg']?></strong>
</div>

<?php elseif ( $_SESSION['inserted'] == 'no' ): ?>
<div class="alert alert-danger" role="alert">
  <strong><?=$_SESSION['inserted_msg']?></strong>
</div>
<?php endif;?>
<?php endif;?>

<!-- form -->
<?=form_open( 'admin/spec/updatespec' )?>
<div class="form-group row">
  <div class="col-md-3 col-sm-12">
    <label>Loại sản phẩm</label>
    <?php $modelOptions = []?>
    <?php foreach ( $models->result() as $model ): ?>
    <?php $modelOptions[$model->id] = $model->model_name?>
    <?php endforeach;?>
    <?php echo form_dropdown( 'modelId', $modelOptions, $spec[0]->modelId, 'class="custom-select"' );
?>
  </div>
</div>
<input type="hidden" name="id" value="<?php echo $spec[0]->id ?>">
<div class="form-group">
  <label>Tên spec</label>
  <input type="text" class="form-control" name="spec_name" value="<?=set_value( 'spec_name', $spec[0]->spec_name )?>">
  <?=form_error( 'spec_name', '<div class="text-danger">', '</div>' )?>
</div>
<div class="form-group">
  <?php echo form_submit( 'submit', 'Lưu', 'class="btn btn-primary float-right"' ); ?>

</div>
<?=form_close();?>
<!-- /form -->
</main>
<!-- /main -->
</div>
</div>

<?php $this->load->view( 'admin/header/footer' );?>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<script>
// CKEDITOR.replace('product_desc', {
//   // extraPlugins: ''
// });

// add thousand without jquery input mask
$('input[name=product_price]').keyup(function(event) {
  if (event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value.replace(/[^\d.]/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  })
});

$('.add_spec_plus').click(function() {
  var count = $('.spec_count').length;
  var sp_row = ""
  sp_row += "<div class='form-group add_spec_value_div remove_" + count + "'>";
  sp_row += "<input type='text' name='spec_val[]' value='' class='form-control spec_count'>";
  sp_row += "<a class='btn btn-danger remove_spec' data-id=" + count + " href='javascript:void(0)'>-</a>";
  sp_row += '</div>';

  if (count < 3) {
    $('.spec_div').append(sp_row);
  }
});

$('body').on('click', '.remove_spec', function() {
  var current = $(this).attr('data-id');
  console.log('remove_' + current);
  $('.remove_' + current).remove();
});
</script>