/* all slider start */
$(document).ready(function () {
  $('.chart-slider').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    autoPlay: true,
    prevArrow: '.prev',
    nextArrow: '.next',
    dots: false,
  });
});