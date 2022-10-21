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
<?=form_open_multipart( 'admin/product/save' )?>
<div class="form-group">
  <label>Tên sản phẩm</label>
  <input type="text" class="form-control" name="product_name" value="<?=set_value( 'product_name' )?>">
  <?=form_error( 'product_name', '<div class="text-danger">', '</div>' )?>
</div>
<!-- row giaban, soluong -->
<div class="row">
  <div class="form-group col-md-6">
    <label>Giá bán</label>
    <input type="text" class="form-control text-right" name="product_price" value="<?=set_value( 'product_price' )?>">
    <?=form_error( 'product_price', '<div class=" text-danger">', '</div>' )?>
  </div>
  <div class="form-group col-md-6">
    <label>Số lượng tồn kho</label>
    <input type="text" class="form-control text-right" name="product_quantity"
      value="<?=set_value( 'product_quantity' )?>">
    <?=form_error( 'product_quantity', '<div class="text-danger">', '</div>' )?>

  </div>
</div>
<!-- /row giaban, soluong -->
<div class="form-group">
  <label>Hình ảnh</label>
  <div class="d-flex justify-content-between">
    <input type="file" class="form-control-file" name="product_cover" id="" placeholder=""
      aria-describedby="fileHelpId">
  </div>
</div>
<div class="form-group">
  <label>Danh mục</label>
  <?php $categoryOptions = []?>
  <?php foreach ( $categories->result() as $category ): ?>
  <?php $categoryOptions[$category->Id] = $category->Name?>
  <?php endforeach;?>
  <?php echo form_dropdown( 'categoryId', $categoryOptions, '', 'class="form-control"' );
?>
</div>
<div class="form-group">
  <label>mô tả</label>
  <textarea type="text" class="form-control" name="product_desc" value="<?=set_value( 'product_desc' )?>"></textarea>
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
CKEDITOR.replace('product_desc', {
  // extraPlugins: ''
});

// add thousand without jquery input mask
$('input[name=product_price]').keyup(function(event) {
  if (event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value.replace(/[^\d.]/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  })
});
</script>