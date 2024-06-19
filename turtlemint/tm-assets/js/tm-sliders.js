/* Slick Arrows */
var slickPrevArrow = '<button type="button" class="tm-sprite-3-before bg-chevron-left-light slick-prev"></button>';
var slickNextArrow = '<button type="button" class="tm-sprite-3-before bg-chevron-right-light slick-next"></button>';

var relatedPostsSlider = $(".slider-related-posts .wp-block-post-template");
$(relatedPostsSlider).slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    speed: 800,
    cssEase: 'ease-in-out',
    prevArrow: slickPrevArrow,
    nextArrow: slickNextArrow,
    infinite: true,
    swipeToSlide: true,
    responsive: [
        {
            breakpoint: 991.98,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 767.98,
            settings: {
                slidesToShow: 2,
                arrows: false
            }
        },
        {
            breakpoint: 575.98,
            settings: {
                slidesToShow: 1,
                arrows: false
            }
        }
    ]
});