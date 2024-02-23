/* Slick Arrows */
var slickPrevArrow = '<button type="button" class="tm-sprite-3-before bg-chevron-left-light slick-prev"></button>';
var slickNextArrow = '<button type="button" class="tm-sprite-3-before bg-chevron-right-light slick-next"></button>';

$(window).on("load", function () {
    if ($(window).width() < 767.98) {
        $(".justify-card-center").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 2000,
          dots: true,
          prevArrow: false,
          nextArrow: false,
        });
        $(".tm-insurance-plan-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: true,
            prevArrow: false,
            nextArrow: false,
          });
    }
});

$('.tm-slider-testimonials').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    prevArrow: slickPrevArrow,
    nextArrow: slickNextArrow,
});
  
// Homepage slider
$(window).on('load', function() {
    $('.homepage-slider').slick({
        arrows: false,
        dots: false,
        autoplay: true
    })
 });

$('.tm-testimonial-raise-claim').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true,
    useTransform: false,
    prevArrow: slickPrevArrow,
    nextArrow: slickNextArrow,
    responsive: [{
        breakpoint:767.98,
        settings: {
            dots: false
        }
    }]
});

/* Post Sliders */
// Select all div elements with a class name starting with "post-slider-"
const postSliderDivs = document.querySelectorAll('div[class*="post-slider-"]');

// Loop through each div element and add slick settings
postSliderDivs.forEach(div => {
    var slider = $(div).find(".wp-block-post-template");
    $(slider).slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        speed: 800,
        cssEase: 'ease-in-out',
        prevArrow: slickPrevArrow,
        nextArrow: slickNextArrow,
        infinite: true,
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
                    arrows:false
                }
            },
            {
                breakpoint: 575.98,
                settings: {
                    slidesToShow: 1,
                    arrows:false
                }
            }
        ]
    });
});

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