
/* Navigation - Header */
$('.tm-header .wp-block-navigation__submenu-container').each(function() {
    $(this).wrapInner('<li class="wp-block-navigation__submenu-container-wrap"><ul class="inner-list"></ul></i>');
});

$('.tm-header .wp-block-navigation-item .wp-block-navigation-item .wp-block-navigation__submenu-icon').each(function(){
    $(this).find('.bg-chevron-down').removeClass('bg-chevron-down').addClass('bg-chevron-right');
});

$('.tm-hamburger').click(function (event) {
    $(this).next('.tm-hamburger-menu').addClass('tm-slide-in')
    $('body').addClass('stop-scroll')
    $('.tm-header .tm-hamburger-menu').before('<div class="modal-backdrop fade show"></div>');
});

$('.tm-hamburger-close').click(function (event) {
    $(this).parents('.tm-hamburger-menu').removeClass('tm-slide-in')
    $('body').removeClass('stop-scroll')
    $('.tm-header').find('.modal-backdrop').remove();
});

$(window).on("load resize", function (){
    if ($(window).width() < 767.98){
        $('.tm-header .wp-block-navigation-item.has-child').each(function(){
            $(this).removeClass('has-child');
            $(this).addClass('tm-has-child');
        });
    }else{
        $('.tm-header .wp-block-navigation-item.tm-has-child').each(function(){
            $(this).addClass('has-child');
            $(this).removeClass('tm-has-child');
        });
    }
});

$('.tm-header').on('click', '.wp-block-navigation-item.tm-has-child', function(event){
    event.stopPropagation();
    $(this).toggleClass('shown');
    $(this).children('.wp-block-navigation__submenu-container').slideToggle();
});

window.addEventListener('scroll', function() {
    if (window.scrollY > 0) {
      $('.tm-header').addClass('scrolled');
    } else {
        $('.tm-header').removeClass('scrolled');
    }
});

$(window).on("load", function () {
    if ($(window).width() < 767.98) {
        /* Footer */
        $('.widgettitle-dropdown').click(function (event) {
            event.stopPropagation();
            $('.widgettitle-dropdown').not(this).next('div').slideUp('medium')
            $('.widgettitle-dropdown').not(this).removeClass('show-submenu')
            $(this).next('div').slideToggle('medium')
            $(this).toggleClass('show-submenu')
        });
        $('footer .tm-collapse').click(function () {
            $('footer .tm-collapse').not(this).find('.footer-heading').removeClass('show-submenu').next('.wp-block-group').slideUp('fast');
            $(this).find('.footer-heading').toggleClass('show-submenu').next('.wp-block-group').slideToggle('fast');
        })
    }
});

// Clickable blog card
const cardElementsToWrap = document.querySelectorAll('.wp-block-post');

cardElementsToWrap.forEach(div => {
    let permalink = $(div).find('.wp-block-post-title a').attr('href');

    // Create a new anchor tag
    const link = document.createElement('a');
    link.href = permalink;  // Set the href attribute
    link.classList.add('wp-block-post__card-link');

    // Move the existing content of the div inside the new anchor tag
    while (div.firstChild) {
        link.appendChild(div.firstChild);
    }

    // Append the new anchor tag inside the div element
    div.appendChild(link);
});

function detectEndOfpage() {
    if ((window.innerHeight + window.pageYOffset) >= (document.body.offsetHeight - 2)) {
        $('.sidebar-trigger').slideUp('fast')
    } else {
        $('.sidebar-trigger').slideDown('fast')
    }
}
window.addEventListener('scroll', detectEndOfpage);