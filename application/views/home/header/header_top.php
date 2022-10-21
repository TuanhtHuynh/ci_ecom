<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
  <div class="offcanvas-logo">
    <a href="/">
      <img src="<?php echo base_url() . '/assets/uploads/logo.png' ?>">
    </a>
  </div>
  <nav class="sidebar_nav">
    <ul>
      <li><a href="/home">Home</a></li>
      <li>
        <a class="sidebar_item" href="#">
          <span>Thực đơn</span>
          <!-- <a>Thực dơn</a> -->
          <span class="sidebar_arrow">
            <i class="fas fa-caret-right"></i>
          </span>
        </a>
        <ul class="dropdown" role="menu" aria-hidden="false" style="display:none;">
          <li>
            <a href="/shop" role="menuitem" tabindex="0">Shop
              Details</a>
          </li>
          <li>
            <a href="/cart" role="menuitem" tabindex="0">Shoping
              Cart</a>
          </li>
          <li>
            <a href="/checkout" role="menuitem" tabindex="0">Check Out</a>
          </li>
          <li>
            <a href="/wish" role="menuitem" tabindex="0">Wisslist</a>
          </li>
          <li>
            <a href="/class" role="menuitem" tabindex="0">Class</a>
          </li>
          <li>
            <a href="/blog" role="menuitem" tabindex="0">Blog
              Details</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="">Giới thiệu</a>
      </li>
    </ul>
  </nav>
</div>
<header class="header">
  <div class="header__top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header__top__inner">
            <div class="header__top__left">
              <ul>
                <!-- <li>USD <span class="arrow_carrot-down"></span>
                  <ul>
                    <li>EUR</li>
                    <li>USD</li>
                  </ul>
                </li>
                <li>ENG <span class="arrow_carrot-down"></span>
                  <ul>
                    <li>Spanish</li>
                    <li>ENG</li>
                  </ul>
                </li> -->
                <li><a href="#">Sign in</a> <span class="arrow_carrot-down"></span></li>
              </ul>
            </div>
            <div class="header__logo">
              <a href="./index.html"><img src="<?php echo base_url() . '/assets/uploads/logo.png' ?>" alt=""></a>
            </div>
            <div class="header__top__right">
              <div class="header__top__right__links">
                <!-- <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""
                    data-pagespeed-url-hash="2396797477"
                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a> -->
                <a href="">
                  <i data-feather="search"></i>
                </a>
                <a href="#"><img src="img/icon/heart.png" alt="" data-pagespeed-url-hash="2466014855"
                    onload="pagespeed.CriticalImages.checkImageForCriticality(this);"></a>
              </div>
              <div class="header__top__right__cart">
                <a href="#">
                  <img src="<?php echo base_url() . '/assets/uploads/cart.png' ?>" alt="">
                  <span>0</span>
                </a>
                <div class="cart__price">Cart: <span>$0.00</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="canvas__open">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <nav class="header__menu mobile-menu">
          <ul>
            <li class="active"><a href="/">Home</a></li>
            <li><a href="./about.html">About</a></li>
            <li><a href="./shop.html">Shop</a></li>
            <li>
              <a href="#">Pages</a>
              <ul class="dropdown">
                <li>
                  <a href="./shop-details.html">Shop Details</a>
                </li>
                <li>
                  <a href="./shoping-cart.html">Shoping Cart</a>
                </li>
                <li>
                  <a href="./checkout.html">Check Out</a>
                </li>
                <li>
                  <a href="./wisslist.html">Wisslist</a>
                </li>
                <li>
                  <a href="./Class.html">Class</a>
                </li>
                <li>
                  <a href="./blog-details.html">Blog Details</a>
                </li>
              </ul>
            </li>
            <li><a href="./blog.html">Blog</a></li>
            <li><a href="./contact.html">Contact</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</header>