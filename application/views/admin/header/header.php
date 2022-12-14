<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.101.0">
  <title>Dashboard Template · Bootstrap v4.6</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">

  <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">


  <!-- Favicons -->
  <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/apple-touch-icon.png"
    sizes="180x180">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-32x32.png" sizes="32x32"
    type="image/png">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon-16x16.png" sizes="16x16"
    type="image/png">
  <link rel="mask-icon" href="/docs/4.6/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
  <link rel="icon" href="https://getbootstrap.com/docs/4.6/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#563d7c">

  <style>
  .bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  form {
    font-size: 1rem;
  }

  form label:not(.form-control):first-child {
    font-weight: bold;
    color: #333;
  }

  form label:first-letter {
    text-transform: uppercase;
  }

  button.btn-warning,
  a.btn-warning svg {
    color: #fff;
  }

  .add_spec_value_div {
    position: relative;
  }

  .add_spec_plus {
    position: absolute;
    top: 1px;
    right: 2px;
  }

  .remove_spec {
    position: absolute;
    top: 1px;
    right: 2px;
  }

  .modal-dialog {
    margin: 20vh auto 0px auto
  }

  label.form-control {
    border: none;
    font-weight: normal;
  }

  @media (min-width: 768px) {
    .bd-placeholder-img-lg {
      font-size: 3.5rem;
    }
  }
  </style>

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.6/examples/dashboard/dashboard.css" rel="stylesheet">
</head>

<body>
  <!-- nav top -->
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
    <!-- <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="<?php echo base_url() . '/admin/login/logout' ?>">Sign out</a>
      </li>
    </ul>
  </nav>

  <!-- nav left -->
  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="<?=base_url() . 'admin/dashboard'?>">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url() . 'admin/category/index'?>">
                <span data-feather="list"></span>
                Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url() . 'admin/product'?>">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() . 'admin/spec' ?>">
                <span data-feather="users"></span>
                Specs
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="users"></span>
                Customers
              </a>
            </li>
          </ul>
        </div>
      </nav>