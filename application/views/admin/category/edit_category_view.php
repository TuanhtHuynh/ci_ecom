<?php $this->load->view( 'admin/header/header' );?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?=$title?></h1>
  </div>
  <form action="<?=base_url() . 'admin/category/update_category'?>" method="POST">
    <input type="hidden" name="category_id" value="<?=$category[0]->Id?>">
    <div class="form-group">
      <label>Tên danh mục</label>
      <input type="text" class="form-control" name="category_name" value="<?=$category[0]->Name?>">
    </div>
    <div class="form-group">
      <label>Actived</label>
      <select class="custom-select" name="category_status">
        <option value="1" <?=( $category[0]->status == '1' ? 'selected' : '' );?>>Actived</option>
        <option value="0" <?=( $category[0]->status == '0' ? 'selected' : '' );?>>DeActived</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary float-right">Lưu</button>
  </form>

  <!-- /main -->
</main>
<!-- /div -->
</div>
<?php $this->load->view( 'admin/header/footer' );?>