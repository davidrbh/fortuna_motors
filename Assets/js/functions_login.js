// Login Page Flipbox control-left
$('.login-content [data-toggle="flip-left"]').click(function () {
  $(".login-box").toggleClass("flipped-left");
  return false;
});

// Login Page Flipbox control-right
$('.login-content [data-toggle="flip-right"]').click(function () {
  $(".login-box").toggleClass("flipped-right");
  return false;
});
