$(window).on('load', function() {
  // Slide de fotos
  $('.shop--product-page--header--gallery').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerPadding: '60px',
    arrows: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 479,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }]
  });

  // Zoom na foto
  $(".shop--product-page--header--main-photo__photo").elevateZoom({
    gallery: "gallery",
    galleryActiveClass: "active",
    zoomWindowWidth: 300,
    zoomWindowHeight: 100,
    scrollZoom: false,
    zoomType: "inner",
    cursor: "crosshair"
  });

  lightGallery(
    document.getElementById('gallery'),
    {
      selector: '.shop--product-page--header--gallery__img',
      download: false
    }
  );
});

$(document.body).on('click', '.zoomWindowContainer', function () {
  var backgroundImageZoomContainer = document.querySelector(".zoomWindowContainer div").style.backgroundImage;
  var arrayOfBackground = backgroundImageZoomContainer.split('url("');
  var arrayOfBackground = arrayOfBackground[1].split('")');
  var url = arrayOfBackground[0];

  var searchImg = document.querySelectorAll(".shop--product-page--header--gallery__img[data-zoom-image='" + url + "']");
  searchImg[0].dispatchEvent(new CustomEvent('click', { bubbles: true, cancelable: true }));
});