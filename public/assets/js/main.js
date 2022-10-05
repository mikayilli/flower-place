$(function () {
  SVGInject(document.querySelectorAll("img.injectable"));
  if ($(".product_carousel")[0]) {
    $(".product_carousel").owlCarousel({
      loop: true,
      margin: 13,
      dots: true,
      nav: true,
      responsive: {
        0: {
          items: 1,
        },
        1000: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
    // $(".product_carousel .owl-prev").html(
    //   '<button type="button"><img src="/assets/images/icons/carouserArrowLeft.svg" alt=""></button>'
    // );
    // $(".product_carousel .owl-next").html(
    //   '<button type="button"><img src="/assets/images/icons/carouserArrowRight.svg" alt=""></button>'
    // );
  }

  if ($(".index_head_carousel")[0]) {
    $(".index_head_carousel").owlCarousel({
      animateOut: 'fadeOut',
      animateIn: "flipInX",
      items: 1,
      margin: 30,
      loop: true,
      dots: false,
      nav: false,
      smartSpeed:450,
      autoplay: true,
      autoplayTimeout: 2000,
      autoplayHoverPause: true,
    });
  }

  if ($(".impressions_carousel")[0]) {
    $(".impressions_carousel").owlCarousel({
      loop: true,
      margin: 46.5,
      dots: true,
      nav: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 1,
        },
        1000: {
          items: 4,
        },
      },
    });
    // if (window.screen.width > 991) {
    //   $(".impressions_carousel .owl-prev").html(
    //     '<button type="button"><img src="/assets/images/icons/carouserArrowLeft.svg" alt=""></button>'
    //   );
    //   $(".impressions_carousel .owl-next").html(
    //     '<button type="button"><img src="/assets/images/icons/carouserArrowRight.svg" alt=""></button>'
    //   );
    // }
    $(".impressions_carousel .owl-prev").html(
      '<button type="button"><img src="/assets/images/icons/carouserArrowLeft2.svg" alt=""></button>'
    );
    $(".impressions_carousel .owl-next").html(
      '<button type="button"><img src="/assets/images/icons/carouserArrowRight2.svg" alt=""></button>'
    );
  }

  if ($(".interesting_carousel")[0]) {
    $(".interesting_carousel").owlCarousel({
      loop: true,
      margin: 10,
      dots: false,
      nav: true,
      responsive: {
        0: {
          items: 1,
        },
        600: {
          items: 1,
        },
        1000: {
          items: 1,
        },
      },
    });
    $(".interesting_carousel .owl-prev").html(
      '<button type="button"><img src="/assets/images/icons/carouserArrowLeft2.svg" alt=""></button>'
    );
    $(".interesting_carousel .owl-next").html(
      '<button type="button"><img src="/assets/images/icons/carouserArrowRight2.svg" alt=""></button>'
    );
  }

  if ($(".card_slider")[0]) {
    $(".card_slider").owlCarousel({
      loop: true,
      margin: 10,
      dots: false,
      nav: true,
      responsive: {
        0: {
          items: 2,
        },
        1000: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
    $(".card_slider .owl-prev").html(
      '<button type="button"><img src="/assets/images/icons/arrowLeft.svg" alt=""></button>'
    );
    $(".card_slider .owl-next").html(
      '<button type="button"><img src="/assets/images/icons/arrowRight.svg" alt=""></button>'
    );
  }
  if ($(".gift_slider")[0]) {
    $(".gift_slider").owlCarousel({
      loop: true,
      margin: 10,
      dots: false,
      nav: true,
      responsive: {
        0: {
          items: 1,
        },
        1000: {
          items: 3,
        },
        1200: {
          items: 4,
        },
      },
    });
    $(".gift_slider .owl-prev").html(
      '<button type="button"><img src="/assets/images/icons/arrowLeft.svg" alt=""></button>'
    );
    $(".gift_slider .owl-next").html(
      '<button type="button"><img src="/assets/images/icons/arrowRight.svg" alt=""></button>'
    );
  }

  var menuOverlay = $(".overlay_inner")[0];
  var menuOverlay1 = $(".overlay_inner")[1];
  var searchBlock = $(".search_block")[0];
  var productFilter = $("#productFilter")[0];

  $(window).on("click", function (e) {
    if (e.target == menuOverlay || e.target == menuOverlay1) {
      $(".overlay_inner").removeClass("active_menu");
      $(".basket_inner").removeClass("active_basket");
      setTimeout(() => {
        $(".mobile_overlay").fadeOut("fast");
        $(".basket_overlay").fadeOut("fast");
      }, 200);
    }
    if (e.target == searchBlock) {
      $(".search_block").removeClass("active_search_block");
      setTimeout(() => {
        $(".mobile_overlay").fadeOut("fast");
      }, 200);
    }
    if (e.target == productFilter) {
      $(".column_inner_product").removeClass("active_filter");
      setTimeout(() => {
        $("#productFilter").fadeOut("fast");
      }, 200);
    }
    $(".profile_menu").fadeOut("fast");
  });

  $(".search_btn").on("click", function () {
    $(".overlay_inner").removeClass("active_menu");
    setTimeout(() => {
      $(".search_block").addClass("active_search_block");
    }, 300);
  });

  $(".mobile_btn_menu").on("click", function (e) {
    e.stopPropagation();
    $(".mobile_overlay").fadeIn("fast");
    setTimeout(() => {
      $(".overlay_inner").addClass("active_menu");
    }, 200);
  });
  $(".close_basket").on("click", function () {
    $(".basket_inner").removeClass("active_basket");
    setTimeout(() => {
      $(".basket_overlay").fadeOut("fast");
    }, 200);
  });
  $(".close_menu").on("click", function () {
    $(".overlay_inner").removeClass("active_menu");
    $(".search_block").fadeIn("fast");
    $(".overlay_inner_cabinet").removeClass("active_menu");
    $(".search_block").removeClass("active_search_block");
    setTimeout(() => {
      $(".mobile_overlay").fadeOut("fast");
      $(".mobile_cabinet_overlay").fadeOut("fast");
    }, 200);
  });
  $(".accordion_btn").on("click", function () {
    $(this).siblings(".accordion").stop().fadeToggle("fast");
    $(this).toggleClass("active_accordion");
  });

  $(document).on("keydown", function (event) {
    if (event.keyCode == 27) {
      $(".my_modal").fadeOut("fast");
    }
  });
  $(document).on("click", ".btn_popup", function (e) {
    e.stopPropagation();
    let dataId = $(this).attr("data-id");
    $(".my_modal").fadeOut("fast");
    $(`#${dataId}`).fadeIn("fast");
  });

  $(document).on("click", ".close_modal", function () {
    $(".my_modal").fadeOut("fast");
  });

  var modalCenter = $(".modal_center");
  for (let i = 0; i < modalCenter.length; i++) {
    const element = modalCenter[i];
    $(window).click(function (e) {
      if (e.target == element) {
        $(".my_modal").fadeOut("fast");
      }
    });
  }

  var lowerSlider = document.querySelector("#lower"); //Lower value slider
  var upperSlider = document.querySelector("#upper"); //Upper value slider

  // var lowerVal = parseInt(lowerSlider.value); //Value of lower slider
  // var upperVal = parseInt(upperSlider.value); // Value of upper slider

  var rangeColor = document.querySelector("#range-color"); //Range color

  if (lowerSlider || upperSlider) {
    //When the upper value slider is moved.
    upperSlider.oninput = function () {
      lowerVal = parseInt(lowerSlider.value); //Get lower slider value
      upperVal = parseInt(upperSlider.value); //Get upper slider value

      //If the upper value slider is LESS THAN the lower value slider plus one.
      if (upperVal < lowerVal + 1) {
        //The lower slider value is set to equal the upper value slider minus one.
        lowerSlider.value = upperVal - 1;
        //If the lower value slider equals its set minimum.
        if (lowerVal == lowerSlider.min) {
          //Set the upper slider value to equal 1.
          upperSlider.value = 1;
        }
      }

      //Setting the margin left of the middle range color.
      //Taking the value of the lower value times 10 and then turning it into a percentage.
      rangeColor.style.marginLeft = lowerSlider.value * 10 + "%";

      //Setting the width of the middle range color.
      //Taking the value of the upper value times 10 and subtracting the lower value times 10 and then turning it into a percentage.
      rangeColor.style.width =
        upperSlider.value * 10 - lowerSlider.value * 10 + "%";

      console.log("upper value: " + upperSlider.value);
    };

    //When the lower value slider is moved.
    lowerSlider.oninput = function () {
      lowerVal = parseInt(lowerSlider.value); //Get lower slider value
      upperVal = parseInt(upperSlider.value); //Get upper slider value

      //If the lower value slider is GREATER THAN the upper value slider minus one.
      if (lowerVal > upperVal - 1) {
        //The upper slider value is set to equal the lower value slider plus one.
        upperSlider.value = lowerVal + 1;

        //If the upper value slider equals its set maximum.
        if (upperVal == upperSlider.max) {
          //Set the lower slider value to equal the upper value slider's maximum value minus one.
          lowerSlider.value = parseInt(upperSlider.max) - 1;
        }
      }

      //Setting the margin left of the middle range color.
      //Taking the value of the lower value times 10 and then turning it into a percentage.
      rangeColor.style.marginLeft = lowerSlider.value * 10 + "%";

      //Setting the width of the middle range color.
      //Taking the value of the upper value times 10 and subtracting the lower value times 10 and then turning it into a percentage.
      rangeColor.style.width =
        upperSlider.value * 10 - lowerSlider.value * 10 + "%";

      console.log("lower value: " + lowerSlider.value);
    };
  }
  // productFilter
  $(".btn_product_filter").on("click", function () {
    $("#productFilter").fadeIn("fast");
    setTimeout(() => {
      $(".column_inner_product").addClass("active_filter");
    }, 300);
  });
  $(".btn_tab").on("click", function () {
    let thisId = $(this).attr("data-id");
    $(this).parent().find(".btn_tab").removeClass("active_tab");
    $(`#${thisId}`)
      .parents(".tabs_container")
      .find(".tab")
      .removeClass("active_tab");
    $(`#${thisId}`).addClass("active_tab");
    $(this).addClass("active_tab");
  });

  //stores carousel

  var sync1 = $(".stores_carousel_main");
  var sync2 = $(".stores_carousel_thumbnails");
  var slidesPerPage = 5; //globaly define number of elements per page
  var syncedSecondary = true;

  if (sync1[0]) {
    sync1
      .owlCarousel({
        items: 1,
        nav: true,
        dots: false,
        loop: true,
        navText: [
          '<button type="button"><img src="/assets/images/icons/carouserArrowLeft.svg" alt=""></button>',
          '<button type="button"><img src="/assets/images/icons/carouserArrowRight.svg" alt=""></button>',
        ],
      })
      .on("changed.owl.carousel", syncPosition);
  }

  if (sync2[0]) {
    sync2
      .on("initialized.owl.carousel", function () {
        sync2.find(".owl-item").eq(0).addClass("current");
      })
      .owlCarousel({
        items: slidesPerPage,
        dots: false,
        margin: 45,
        nav: false,
        slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
        responsive: {
          0: {
            margin: 10,
          },
        },
      })
      .on("changed.owl.carousel", syncPosition2);
  }

  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;

    //if you disable loop you have to comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }

    //end block

    sync2
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = sync2.find(".owl-item.active").length - 1;
    var start = sync2.find(".owl-item.active").first().index();
    var end = sync2.find(".owl-item.active").last().index();

    if (current > end) {
      sync2.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      sync2.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      sync1.data("owl.carousel").to(number, 100, true);
    }
  }

  sync2.on("click", ".owl-item", function (e) {
    e.preventDefault();
    var number = $(this).index();
    sync1.data("owl.carousel").to(number, 300, true);
  });

  $("#search_input").on("focus", function () {
    $(".search_result_block").fadeIn("fast");
  });

  $("#search_input").on("blur", function () {
    $(".search_result_block").fadeOut("fast");
  });

  $(".btn_show_map").click(function () {
    $(".stores_carousel_main").trigger("to.owl.carousel", 0);
    $(".stores_carousel_thumbnails").trigger("to.owl.carousel", 0);
  });

  $(".color_item").on("click", function () {
    $(this).toggleClass("active_item");
  });

  const imgs = document.querySelectorAll(".img-select a");
  const imgBtns = [...imgs];
  let imgId = 1;

  imgBtns.forEach((imgItem) => {
    imgItem.addEventListener("click", (event) => {
      event.preventDefault();
      imgId = imgItem.dataset.id;
      slideImage();
    });
  });

  function slideImage() {
    const displayWidth = document.querySelector(".img-showcase img:first-child")
      .clientWidth;

    document.querySelector(".img-showcase").style.transform = `translateX(${
      -(imgId - 1) * displayWidth
    }px)`;
  }

  window.addEventListener("resize", slideImage);

  if ($(".product_main_popup")[0]) {
    $(".product_main_popup").magnificPopup({
      delegate: $(".item"), // child items selector, by clicking on it popup will open
      type: "image",
      gallery: {
        enabled: true,
      },
      // other options
    });
  }
  if ($(".card_slider")[0]) {
    $(".card_slider").magnificPopup({
      delegate: "a", // child items selector, by clicking on it popup will open
      type: "image",
      gallery: {
        enabled: true,
      },
      // other options
    });
  }
  if ($(".gift_slider")[0]) {
    $(".gift_slider").magnificPopup({
      delegate: "a", // child items selector, by clicking on it popup will open
      type: "image",
      gallery: {
        enabled: true,
      },
      // other options
    });
  }
  if ($(".product_slider_popup")[0]) {
    $(".product_slider_popup").magnificPopup({
      delegate: ".show_btn", // child items selector, by clicking on it popup will open
      type: "image",
      gallery: {
        enabled: true,
      },
      // other options
    });
  }
  $("#add_comment").on("click", function () {
    if ($(this).is(":checked")) {
      $(this)
        .parent(".custom_checkbox")
        .siblings(".comment_block")
        .fadeIn("fast");
    } else {
      $(this)
        .parent(".custom_checkbox")
        .siblings(".comment_block")
        .fadeOut("fast");
    }
  });
  $(".btn_show_slider").on("click", function () {
    let thisId = $(this).attr("data-id");
    $(`#${thisId}`).fadeToggle("fast");
  });
  $(".btn_basket").on("click", function () {
    $(".basket_overlay").fadeIn("fast");
    $(".basket_inner").addClass("active_basket");
  });
  $(".btn_accordion_list").on("click", function () {
    $(this).siblings(".accordion_list_in").fadeToggle("fast");
    $(this).toggleClass("active_accordion");
  });
  $(".btn_profile").on("click", function (e) {
    e.stopPropagation();
    $(".profile_menu").fadeIn("fast");
  });
  $(".rating__button").on("click", function (e) {
    var $t = $(this), // the clicked star
      $ct = $t.parent(); // the stars container

    // add .is--active to the user selected star
    $t.siblings().removeClass("is--active").end().toggleClass("is--active");
    // add .has--rating to the rating container, if there's a star selected. remove it if there's no star selected.
    $ct.find(".rating__button.is--active").length
      ? $ct.addClass("has--rating")
      : $ct.removeClass("has--rating");
  });

  var imageDiv = $(".upload_block");

  $("#file_input").on("change", (e) => {
    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);
    filesArr.forEach(function (f) {
      if (f.type.match("image.*")) {
        var reader = new FileReader();
        reader.onload = function (e) {
          var innerItemImage = `<img class="img" src="${e.target.result}" alt="#">
          <button type="button" class="btn_remove_img">Удалить</button>`;
          imageDiv.html(innerItemImage);
          $(".add_comment_img").remove();
        };
        reader.readAsDataURL(f);
      } else {
        alert("Only image");
      }
    });
  });

  $(document).on("click", ".btn_remove_img", function () {
    var addButton = `<div class="add_comment_img">
    <input type="file" id="file_input">
    <span>Прикрепить фото</span>
</div>`;
    imageDiv.find(".img").remove();
    imageDiv.find(".btn_remove_img").remove();
    imageDiv.append(addButton);
  });
  var readURL = function (input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(".product-pic").attr("src", e.target.result).removeClass("empty_img");
      };

      reader.readAsDataURL(input.files[0]);
    }
  };

  if (window.screen.width < 991) {
    $(".column_head_nav").on("click", function () {
      let thisId = $(this).attr("data-id");
      $(`#${thisId}`).fadeToggle("fast");
    });
  }

  $(".file-upload").on("change", function () {
    readURL(this);
  });
  $(".btn_edit_remember").on("click", function () {
    $(".address_block").fadeOut("fast");
    setTimeout(() => {
      $(".edit_adress_block").fadeIn("fast");
    }, 200);
  });
  $(".btn_save_edit").on("click", function () {
    $(".edit_adress_block").fadeOut("fast");
    setTimeout(() => {
      $(".address_block").fadeIn("fast");
    }, 200);
  });
});
