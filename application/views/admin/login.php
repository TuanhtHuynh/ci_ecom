<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Signin</title>

  <link rel="canonical" href="https://getbootstrap.comhttps://getbootstrap.com/docs/4.6/examples/sign-in/">



  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <!-- Favicons -->
  <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/apple-touch-icon.png"
    sizes="180x180">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32"
    type="image/png">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16"
    type="image/png">
  <link rel="manifest" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/safari-pinned-tab.svg"
    color="#563d7c">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon.ico">
  <meta name="msapplication-config" content="https://getbootstrap.com/docs/4.6/assets/img/favicons/browserconfig.xml">
  <meta name="theme-color" content="#563d7c">


  <style>
  form .form-group,
  form .alert {
    text-align: left;
  }

  form label:first-child {
    font-weight: bold;
  }

  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  </style>


  <!-- Custom styles for this template -->
  <link href="<?php echo base_url() . 'assets/css/signin.css' ?>" rel="stylesheet">
</head>

<body class="text-center">

  <form class="form-signin" action="<?=base_url() . 'admin/login/validation'?>" method="POST">
    <h1 class="h3 mb-3 font-weight-normal"><?=$title?></h1>

    <?php if ( isset( $_SESSION['error'] ) ) {?>
    <div class="alert alert-danger" role="alert">
      <strong><?=$_SESSION['error']?></strong>
    </div>
    <?php }?>

    <div class="form-group">
      <label for="inputEmail" class="">Email address</label>
      <input type="text" id="inputEmail" class="form-control" name="user_email" placeholder="Email address"
        value="<?=set_value( 'user_email' )?>" autofocus>
      <?=form_error( 'user_email', '<div class="text-danger">', '</div>' );?>
    </div>

    <div class="form-group">
      <label for="inputPassword">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="user_password"
        value="<?=set_value( 'user_password' )?>">
      <?=form_error( 'user_password', '<div class="text-danger">', '</div>' );?>
    </div>
    <div class="mb-3">
      <a href="<?=base_url() . 'register'?>">Đăng kí tài khoản</a>
    </div>
    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
  </form>



</body>

</html>