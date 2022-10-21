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
<?php echo form_open_multipart( 'admin/product/update' ) ?>
<input name="product_id" type="hidden" value="<?php echo $product[0]->id ?>">
<div class="form-group">
  <label>Tên sản phẩm</label>
  <input type="text" class="form-control" name="product_name" value="<?=$product[0]->product_name?>">
  <?php echo form_error( 'product_name', '<div class="text-danger">', '</div>' ) ?>
</div>

<!-- row giaban, soluong -->
<div class="row">
  <div class="form-group col-md-6">
    <label>Giá bán</label>
    <input type="text" class="form-control text-right" name="product_price" value="<?=$product[0]->price?>">
    <?=form_error( 'product_price', '<div class=" text-danger">', '</div>' )?>
  </div>
  <div class="form-group col-md-6">
    <label>Số lượng tồn kho</label>
    <input type="text" class="form-control text-right" name="product_quantity" value="<?=$product[0]->quantity?>">
    <?=form_error( 'product_quantity', '<div class="text-danger">', '</div>' )?>

  </div>
</div>
<!-- /row giaban, soluong -->

<input name="oldcover" type="hidden" value="<?php echo $product[0]->product_cover ?>">
<div class="form-group row">
  <div class="col-md-6">
    <label>Hình ảnh</label>
    <div class="custom-file">
      <label class="custom-file-label">chọn file</label>
      <?php echo form_upload( 'product_cover', '', 'class="custom-file-input"' ) ?>
    </div>
  </div>
  <div class="col-md-6">
    <div></div>
    <img class="img-response" style="width: 50%; height: 100%"
      src="<?=base_url() . 'assets/uploads/' . $product[0]->product_cover?>">
  </div>
</div>
<div class="form-group">
  <label>mô tả</label>
  <?php echo $product[0]->product_desc ?>
  <textarea type="text" class="form-control" name="product_desc"><?=$product[0]->product_desc?></textarea>
</div>
<div class="form-group">
  <?php echo form_submit( 'submit', 'Lưu', 'class="btn btn-primary float-right"' ); ?>
</div>
<?php echo form_close(); ?>
<!-- /form -->
</main>
<!-- /main -->
</div>
</div>

<?php $this->load->view( 'admin/header/footer' );?>
<script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

<script>
CKEDITOR.replace('product_desc');

// add thousand without jquery input mask
$('input[name=product_price]').keyup(function(event) {
  if (event.which >= 37 && event.which <= 40) return;
  $(this).val(function(index, value) {
    return value.replace(/[^\d.]/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  })
});
</script>