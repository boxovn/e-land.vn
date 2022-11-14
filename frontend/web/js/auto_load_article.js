var limit = 0;
var offset = 0;
var total = 0;
var columnHeight = 0;
var listboxHeight = 0;
/*
$(document).ready(function () {
  listboxWidth = $("#list-box").width(); // listbox width
  listboxHeight = $("#list-box").height(); //
  offset = total = $(".column").length; // number column after get page
  columnHeight = $(".column").height(); // column height
  limit = listboxWidth / 214; // get number block to limit. every a block is width 214px
});
$(window).scroll(function () {
  if ($(window).scrollTop() + window.innerHeight >= $(document).height()) {
    loadArticle();
  }
});
*/

function loadArticle(slug, page) {
  listboxWidth = $("#list-box").width(); // listbox width
  listboxHeight = $("#list-box").height(); //
  offset = total = $(".column").length; // number column after get page
  columnHeight = $(".column").height(); // column height
  limit = listboxWidth / 214; // get number block to limit. every a block is width 214px
  $.ajax({
    url: $(location).attr("origin") + "/article-loading",
    type: "GET",
    dataType: "json",
    async: false, //this turns it into synchronous
    data: {
      offset: offset,
      limit: limit * 2,
      slug: slug,
      page: page,
    },
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (data) {
      // if (data.info.building.lenght > 0) {
      html = "";
      $(".loader").hide();
      //html += '<div class="list-box" style="width:' + $(".list-box").width() + 'px">';
      //html +=  '<div style="width: 100%; margin: 0px auto 50px auto; border-bottom: 1px solid #ddd;"></div>';
      $.each(data.info.building, function (index, val) {
        html += '<div class="column" >';
        html += '<div class="box-image" href="' + val.href + '">';
        html += '<a title="' + val.title + '" href="' + val.href + '">';
        html +=
          '<img class="image" alt="' +
          val.title +
          '" src="' +
          val.image +
          '"/>';
        html += "</a>";
        html += '<div class="box-label">';

        html +=
          '<a title="' + val.user_name + '" href="' + val.user_image + '">';
        html +=
          '<img alt="' +
          val.user_name +
          '" class="user_avatar" src="' +
          val.user_image +
          '" />';
        html += "</a>";

        html += '<div class="info">';
        html += "<span>Giá: " + val.price_text + "</span>";
        html += "<span>Diện tích :" + val.area_text + "</span>";
        html += "</div>";

        html += "</div>";
        html += '<div class="box-time">';
        html += '<i class="fa fa-clock-o" aria-hidden="true"></i>';
        html += "<span>" + val.date_post + " </span>";
        html += "</div>";
        html += "</div>";
        html += '<div class="box-description">';
        html += '<div class="wap-title">';
        html +=
          '<a title="' +
          val.title +
          '" class="title" href="' +
          val.href +
          '">' +
          val.title +
          "</a>";
        html += "</div>";
        html += '<div class="province">';
        if (val.district_name.length > 0 && val.province_name.length > 0) {
          html +=
            '<a title="' +
            val.address +
            '" href="' +
            val.district_link +
            '">' +
            val.district_name +
            "</a>";
          html +=
            '<a title="' +
            val.address +
            '" href="' +
            val.province_link +
            '">, ' +
            val.province_name +
            "</a>";
        } else if (val.province_name.length > 0) {
          html +=
            '<a title="' +
            val.address +
            '" href="' +
            val.province_link +
            '">' +
            val.province_name +
            "</a>";
        } else if (val.district_name.length > 0) {
          html +=
            '<a title="' +
            val.address +
            '" href="' +
            val.district_link +
            '">' +
            val.district_name +
            "</a>";
        }
        html += "</div>";
        html += "</div>";
        html += "</div>";
      });
      //html += "</div>";
      offset = data.info.offset;
      total = data.info.total;
      //$(html).appendTo($("#list-box"));
      //$(".body:last").append(html);
      $(".column").last().after(html);
      // scrollTop after add column into list-box

      $("html,body").animate(
        {
          scrollTop: $(window).scrollTop(),
        },
        "slow"
      );
      // } else {
      // alert("Tin rao đã hết");
      //}
    },
  });
}
