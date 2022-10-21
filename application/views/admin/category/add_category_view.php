<?php $this->load->view( 'admin/header/header' );?>
<?php $this->load->view( 'admin/header/main_container' );?>

<!-- message -->
<?php if ( isset( $_SESSION['inserted'] ) ): ?>
<?php if ( $_SESSION['inserted'] == 'yes' ): ?>
<div class="alert alert-success" role="alert">
  <strong>đã thêm danh mục mới</strong>
</div>
<?php endif;?>
<?php endif;?>
<!-- /message -->

<?php echo form_open( 'admin/category/save_category' ) ?>
<div class="form-group">
  <label>Tên danh mục</label>
  <input type="text" class="form-control" name="category_name">
</div>
<div class="form-group">
  <?php echo form_submit( 'submit', 'Lưu', 'class="btn btn-primary"' ); ?>
</div>
<?php echo form_close(); ?>

</div>
<!-- /div -->
</main>
<!-- /main -->
</div>
<?php $this->load->view( 'admin/header/footer' );?>