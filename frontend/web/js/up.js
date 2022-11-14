$(window).scroll(function () {
  if ($(this).scrollTop() > 500) {
    $("#top-link-block").addClass("affix").removeClass("affix-top");
  } else {
    $("#top-link-block").addClass("affix-top").removeClass("affix");
  }
});
$(window).scroll(function () {
  if ($(this).scrollTop() > 810) {
    $("#ctsElsWrapper").addClass("affix").removeClass("affix-top");
  } else {
    $("#ctsElsWrapper").addClass("affix-top").removeClass("affix");
  }
});
