<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js">
</script>
<script>
$('.canvas__open').on('click', function() {
  $('.offcanvas-menu-overlay').addClass('active');
  $('.offcanvas-menu-wrapper').addClass('active');
});
$('.offcanvas-menu-overlay').on('click', function() {
  $('.offcanvas-menu-overlay').removeClass('active');
  $('.offcanvas-menu-wrapper').removeClass('active');
});
$('.sidebar_item').on('click', function() {
  $('.sidebar_nav .dropdown').slideToggle(500);
  // $('.sidebar_arrow i').toggleClass('fa-rotate-by');
  $('.sidebar_arrow i').toggleClass('rotate-90');

})
</script>
</body>