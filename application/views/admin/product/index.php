<?php $this->load->view( 'admin/header/header' );?>
<?php $this->load->view( 'admin/header/main_container' )?>
<div class="d-flex justify-content-between mb-3">
  <div></div>
  <a class="btn btn-primary d-flex align-items-center" href="<?=base_url() . 'admin/product/addproduct'?>">
    <i class="mr-3" data-feather="plus"></i>Thêm sản phẩm
  </a>
  <a class="btn btn-primary d-flex align-items-center" href="<?=base_url() . 'admin/product/edit/13'?>">
    <i class="mr-3" data-feather="plus"></i>Cập nhật
  </a>
</div>
<?php if ( $products ): ?>
<?php foreach ( $products as $product ): ?>
<div><?=$product->product_name?></div>
<a href="" class="btn btn-danger btn-sm delete" data-id="<?php echo $product->id ?>"
  data-text="<?php echo $this->encryption->encrypt( $product->id ) ?>"><i class=" align-items-center"
    data-feather="trash-2"></i>
</a>
<?php endforeach;?>
<?php endif;?>
<div class="my-3 d-flex">
  <?=$links?>
</div>
</main>
</div>
</div>
<?php $this->load->view( 'admin/header/footer' );?>
<script type="text/javascript">
$('.delete').click(function() {
  var id = $(this).attr('data-id');
  var text = $(this).attr('data-text');
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url() . 'admin/product/delete/' ?>',
    data: {
      id: id,
      text: text
    },
    success: function(data) {
      alert(data);
      console.log(data);
    }
  });
});
</script>