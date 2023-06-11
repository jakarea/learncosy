/* all slider start */
$('.services-slider-wrap').slick({
  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  autoPlay: true,
  centerMode: false,
  dots: true, 
  responsive: [
    {
      breakpoint: 992,
      settings: {
        arrows: false,
        dots: false,
        centerMode: false,
        centerPadding: '15px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        dots: true,
        centerMode: false,
        centerPadding: '0px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        dots: true,
        centerMode: true,
        centerPadding: '10px',
        slidesToShow: 1
      }
    }
  ]
}); 

$('.feat-mobile-slider').slick({ 
  mobileFirst: true, 
  arrows: false,
  dots: true,
  responsive: [
    {
        breakpoint: 2000,
        settings: "unslick"
    },
    {
        breakpoint: 1600,
        settings: "unslick"
    },
    {
        breakpoint: 1024,
        settings: "unslick"
    },
    {
        breakpoint: 600,
        settings: "unslick"
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            dots: true,
            arrows: false,
            slidesToScroll: 1
        }
    }
  ]
}); 
$('.popular-mobile-slider').slick({ 
  mobileFirst: true, 
  arrows: false,
  dots: true,
  responsive: [
    {
        breakpoint: 2000,
        settings: "unslick"
    },
    {
        breakpoint: 1600,
        settings: "unslick"
    },
    {
        breakpoint: 1024,
        settings: "unslick"
    },
    {
        breakpoint: 600,
        settings: "unslick"
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            dots: true,
            arrows: false,
            slidesToScroll: 1
        }
    }
  ]
}); 
$('.rev-mobile-slider').slick({ 
  mobileFirst: true, 
  arrows: false, 
  dots: true,
  responsive: [
    {
        breakpoint: 2000,
        settings: "unslick"
    },
    {
        breakpoint: 1600,
        settings: "unslick"
    },
    {
        breakpoint: 1024,
        settings: "unslick"
    },
    {
        breakpoint: 600,
        settings: "unslick"
    },
    {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            dots: true,
            arrows: false,
            slidesToScroll: 1
        }
    }
  ]
}); 