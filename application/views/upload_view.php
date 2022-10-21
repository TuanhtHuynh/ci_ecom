<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
</head>

<body>
  <div class="container">
    <h1>Tải file</h1>

    <!-- <form action="<?=base_url()?>uploaded/do_upload" method="POST" enctype="multipart/form-data"> -->
    <?php echo form_open_multipart( 'uploaded/do_upload' ) ?>
    <input type="file" name="imgFile" class="form-control">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <!-- </form> -->
  </div>
</body>

</html>