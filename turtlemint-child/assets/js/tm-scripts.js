$(window).on("load", function () {
    // Code Only For Mobile
    if ($(window).width() > 992) {
        /* Remove Duplicate Form */
        $('.d-lg-none > .tm-section-select-insurance').empty()
    }
    if ($(window).width() < 991.98) {
        /* Remove Duplicate Form */
        $('.d-none > .tm-section-select-insurance').empty()
    }
    if ($(window).width() < 767.98) {
        /* Navigation - Header */
        $('.tm-hamburger').click(function (event) {
            $(this).next('.tm-hamburger-menu').addClass('tm-slide-in')
            $('body').addClass('stop-scroll')

            /* Event - start*/
            gtag("event", "Hamburger_Mobile_btn-click", {
                event_category: "HP-Buttons",
                event_label: "Hamburger",
            });
            /* Event - end */
        });
        $('.gtag-m-find-advisor').click(function () {
            /* Event - start*/
            gtag("event", "Find_advisor-Mobile", {
                event_category: "Mega-Menu-Click",
                event_label: "Find Advisor",
            });
            /* Event - end */
        });
        $('.tm-hamburger-close').click(function (event) {
            $(this).parents('.tm-hamburger-menu').removeClass('tm-slide-in')
            $('body').removeClass('stop-scroll')
        });
        if (!($('.tm-menu-item.has-megamenu .tm-megamenu').find('.tm-button-back').length)) {
            $('.tm-menu-item.has-megamenu').find('.tm-megamenu').prepend('<button class="tm-button-back tm-sprite-3-before bg-arrow-left">Back</button>')
        }
        $('.tm-menu-item.has-megamenu').click(function (event) {
            $(this).find('.tm-megamenu').addClass('tm-slide-in')
            $(this).parents('.tm-hamburger-menu__main').addClass('tm-slide-out')
        });
        $('.tm-button-back').click(function (event) {
            event.stopPropagation();
            $(this).parents('.tm-hamburger-menu__main').removeClass('tm-slide-out')
            $(this).parents('.tm-megamenu').removeClass('tm-slide-in')
        });
        $('.widgettitle-dropdown').click(function (event) {
            event.stopPropagation();
            $('.widgettitle-dropdown').not(this).next('div').slideUp('medium')
            $('.widgettitle-dropdown').not(this).removeClass('show-submenu')
            $(this).next('div').slideToggle('medium')
            $(this).toggleClass('show-submenu')
        });
        /* Footer */
        $('footer .tm-collapse').click(function () {
            $('footer .tm-collapse').not(this).find('.footer-heading').removeClass('show-submenu').next('.wp-block-group').slideUp('fast');
            $(this).find('.footer-heading').toggleClass('show-submenu').next('.wp-block-group').slideToggle('fast');
        })
    }
    $('.gtag-app-download').click(function () {
        /* Event - start*/
        gtag("event", "Claim_App_download_click", {
            event_category: "HP-Buttons",
            event_label: "Download Now",
        });
        /* Event - end */
    });
});

// About page image differ
// Select the img element inside the wp-block-cover section
$('.tm-outing .wp-block-cover img').attr('loading', 'lazy');

/* To display truncated text as title attribute */
const truncatedLinks = document.querySelectorAll('.tm-truncate-link a');
const truncatedLinkLines = document.querySelectorAll('.tm-truncate-link-lines a');
const truncatedTexts = document.querySelectorAll('.tm-truncate');
const truncatedLines = document.querySelectorAll('.tm-truncate-lines');

const truncateGroup = [truncatedLinks, truncatedLinkLines, truncatedTexts, truncatedLines];

truncateGroup.forEach(truncateElements => {
    truncateElements.forEach(truncateElement => {
        truncateElement.title = truncateElement.textContent;
    });
})

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
window.addEventListener('scroll', detectEndOfpage)

// check if element is in viewport
function inViewport(el) {
    const { top, bottom } = el.getBoundingClientRect();
    return (window.innerHeight > top && bottom > 0);
}

// Function to load the image
function loadDataImage(element) {
    var imgSrc = element.getAttribute('data-imgsrc');
    if (imgSrc) {
        element.setAttribute('src', imgSrc);
        element.removeAttribute('data-imgsrc');
    }
}
// Function to add class if image is loaded
function imageLoaded(element) {
    element.classList.add("show-img")
}

// Function to load section
function loadSection(section) {
    $(section).removeClass("hiddenSection");
}
// Function to handle scroll event
function handleScroll() {
    var lazyImages = document.querySelectorAll('img[data-imgsrc]');
    lazyImages.forEach(function (img) {
        if (inViewport(img)) {
            loadDataImage(img);
        }
    });
    var hiddenSections = document.querySelectorAll('.hiddenSection');
    hiddenSections.forEach(function (hiddenSection) {
        if (inViewport(hiddenSection)) {
            loadSection(hiddenSection);
        }
    });
}

// Attach scroll event listener
window.addEventListener('scroll', handleScroll);

$(".show-more-partners").on('click', function (event) {
    // Prevent default behavior
    event.preventDefault();

    // All of the hidden images
    let $hidden = $(".tm-partners .partner:hidden");

    //All of visible images except first 5
    let $visible = $(".tm-partners .partner.visible");

    // Hide if there are visible images
    if ($visible.length > 0) {
        $visible.fadeOut(800);
        $($visible).removeClass("visible");
        $('html, body').animate({
            scrollTop: $(".tm-partners").offset().top - 180
        }, 1000);
        $(this).find('a').text('View More');
    } else {
        // Show the next five images
        $($hidden).fadeIn(800);
        $($hidden).addClass("visible");
        $(this).find('a').text('View Less');
    }
    handleScroll();
});

$(document).ready(function () {
    /* Secondary Navbar Dropdown */
    $('.tm-secondary-nav .menu-item.has-dropdown a').click(
        function (event) {
            $(this).parent().find('.dropdown-expand').toggleClass("nav-show");
            $(this).toggleClass("expanded");
        }
    )
    $('.tm-secondary-nav .menu-item.has-dropdown ul').click(
        function () {
            $(this).parent().toggleClass("nav-show");
            $(this).parent().prev().toggleClass("expanded");
        }
    )
    $(document).click(function (e) {
        var secNavLink = $(".tm-secondary-nav .menu-item.has-dropdown a");
        if (!secNavLink.is(e.target) &&
            secNavLink.has(e.target).length === 0) {
            $(secNavLink).parent().find('.dropdown-expand').removeClass("nav-show");
            $(secNavLink).removeClass("expanded");
        }
    });
    // Check if the navigation bar is present on the page
    if ($('nav.nav-horizontal-scroll').length > 0) {
        // Scroll to the top of the page
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    }

    // Function to update the active link based on scroll position
    function updateActiveLinkOnScroll() {
        var scrollPos = $(window).scrollTop();
        var isAnySectionInView = false; // Flag to check if any section is in view

        // Loop through sections with class "highlight-section"
        $('.highlight-section').each(function (index, element) {
            var sectionTop = $(element).offset().top - 142;
            var sectionBottom = sectionTop + $(element).outerHeight();
            var sectionId = $(element).attr('id');
            var menuItem = $('nav.nav-horizontal-scroll ul li a[href="#' + sectionId + '"]');

            if (scrollPos >= sectionTop && scrollPos < sectionBottom) {
                // Add "nav-active" class to the corresponding menu item
                menuItem.closest('li').addClass('nav-active');
                isAnySectionInView = true; // Set the flag to true
            } else {
                // If section is not in view, remove "nav-active" class
                menuItem.closest('li').removeClass('nav-active');
            }
        });

        // If no section is in view, remove "nav-active" from all menu items
        if (!isAnySectionInView) {
            $('nav.nav-horizontal-scroll ul li').removeClass('nav-active');
        }
    }

    // Function to scroll the active link into view
    function scrollActiveLinkIntoView() {
        var activeLink = $('nav.nav-horizontal-scroll ul li.nav-active');

        if (activeLink.length > 0) {
            var container = $('nav.nav-horizontal-scroll ul.nav-horizontal-scroll-list');
            var containerScrollLeft = container.scrollLeft();

            // Check if the active link is inside a dropdown container
            var dropdownContainer = activeLink.closest('.menu-item.has-dropdown');
            if (dropdownContainer.length > 0) {
                // Calculate the offset of the dropdown container
                var dropdownOffset = dropdownContainer.offset().left - container.offset().left + containerScrollLeft;

                // Scroll the container to make the dropdown container visible
                smoothScroll(container[0], dropdownOffset, 1000);
            } else {
                // Calculate the offset of the active link
                var linkOffset = activeLink.offset().left - container.offset().left + containerScrollLeft;

                // Calculate the maximum allowable scroll position (container width - viewport width)
                var maxScroll = container[0].scrollWidth - container.width();

                // Scroll the container to make the active link visible
                smoothScroll(container[0], Math.min(linkOffset, maxScroll), 1000);
            }
        }
    }

    // Function for smooth scrolling
    function smoothScroll(element, to, duration) {
        var start = element.scrollLeft,
            change = to - start,
            currentTime = 0,
            increment = 20;

        function animateScroll() {
            currentTime += increment;
            var val = Math.easeInOutQuad(currentTime, start, change, duration);
            element.scrollLeft = val;

            if (currentTime < duration) {
                requestAnimationFrame(animateScroll);
            }
        }

        animateScroll();
    }

    // Easing function for smooth scroll
    Math.easeInOutQuad = function (t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    };

    // Smooth scroll to section when clicking on hash links
    $('a[href^="#"]').on('click', function (event) {
        var target = $($(this).attr('href'));
        if (target.length) {
            event.preventDefault();
            var scrollTopValue = target.offset().top - 140;
            $('html, body').animate({
                scrollTop: scrollTopValue
            }, 1000, function () {
                // Add "nav-active" class to the clicked link after scrolling
                $('nav.nav-horizontal-scroll ul li').removeClass('nav-active');
                $(event.target).closest('li').addClass('nav-active');
            });
        }
    });

    // Function to handle menu item clicks
    $('nav.nav-horizontal-scroll ul .menu-item:not(.has-dropdown) a').on('click', function (event) {
        // Remove "nav-active" class from all menu items
        $('nav.nav-horizontal-scroll ul li').removeClass('nav-active');
        // Add "nav-active" class to the clicked menu item
        $(event.target).closest('li').addClass('nav-active');
        // Scroll the active link into view
        scrollActiveLinkIntoView();
    });

    // Update active link on scroll
    $(window).on('scroll', updateActiveLinkOnScroll);
    $(window).on('scroll', scrollActiveLinkIntoView);
});

// Expandable sections
function expandableContentHeight() {
    var expandableContentElements = document.querySelectorAll('.tm-container__content[data-max-height-mob]');
    if (expandableContentElements) {
        expandableContentElements.forEach(expandableContentElement => {
            var maxContentHeight;
            if ($(window).width() < 767.98) {
                maxContentHeight = parseInt(expandableContentElement.getAttribute('data-max-height-mob'));
            } else {
                maxContentHeight = parseInt(expandableContentElement.getAttribute('data-max-height'));
            }

            expandableContentElement.style.maxHeight = maxContentHeight + 'px';
        });
    }
}

expandableContentHeight();

function toggleContent(linkElement) {
    var contentElement = linkElement.parentNode.parentNode.querySelector('.tm-container__content');

    let sectionCard = linkElement.closest('.plan-card');
    let section = linkElement.closest('section');

    if (contentElement) {
        var maxContentHeight;
        if ($(window).width() < 767.98) {
            maxContentHeight = parseInt(contentElement.getAttribute('data-max-height-mob'));
        } else {
            maxContentHeight = parseInt(contentElement.getAttribute('data-max-height'))
        }

        let eventAction = linkElement.dataset.eventaction;
        let eventCategory = linkElement.dataset.eventcategory;
        let eventLabel = linkElement.dataset.eventlabel;
        let ctadetails = linkElement.dataset.ctadetails;
        let ctavalue = linkElement.dataset.ctavalue;

        let titleTag = linkElement.querySelector(".icon-link").title;
        let updatedTitleTag;
        let ctaText = linkElement.querySelector('span').innerText;
        let updatedCtatext;

        if (contentElement.style.maxHeight) {
            contentElement.style.maxHeight = null;
            linkElement.classList.add('shown');

            if (ctaText.includes('More')) {
                updatedCtatext = ctaText.replace('More', 'Less');
            } else {
                updatedCtatext = ctaText;
            }

            if (titleTag.includes('More')) {
                updatedTitleTag = titleTag.replace('More', 'Less');
            } else {
                updatedTitleTag = titleTag;
            }

            linkElement.querySelector('span').innerText = updatedCtatext;
            linkElement.querySelector(".icon-link").title = updatedTitleTag;
            contentElement.classList.remove("has-toggle-expand-cta");

            if (eventAction && eventCategory && eventLabel) {
                linkElement.setAttribute("onclick", "toggleContent(this)");
            }
        } else {
            contentElement.style.maxHeight = maxContentHeight + 'px';
            linkElement.classList.remove('shown');

            if (ctaText.includes('Less')) {
                updatedCtatext = ctaText.replace('Less', 'More');
            } else {
                updatedCtatext = ctaText;
            }

            if (titleTag.includes('Less')) {
                updatedTitleTag = titleTag.replace('Less', 'More');
            } else {
                updatedTitleTag = titleTag;
            }

            linkElement.querySelector('span').innerText = updatedCtatext;
            linkElement.querySelector(".icon-link").title = updatedTitleTag;
            contentElement.classList.add("has-toggle-expand-cta");

            if (sectionCard) {
                window.scrollTo({
                    top: sectionCard.offsetTop - 140,
                    behavior: 'smooth'
                });
            }
            else if (section) {
                window.scrollTo({
                    top: section.offsetTop - 140,
                    behavior: 'smooth'
                });
            } else { }

            if (eventAction && eventCategory && eventLabel && ctadetails) {
                linkElement.setAttribute("onclick", "toggleContent(this);tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "', '" + ctadetails + "')");
            }else if (eventAction && eventCategory && eventLabel && ctavalue && !ctadetails) {
                linkElement.setAttribute("onclick", "toggleContent(this);tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "', '', '" + ctavalue + "')");
            }else if (eventAction && eventCategory && eventLabel) {
                linkElement.setAttribute("onclick", "toggleContent(this);tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "')");
            }
        }
    }
}

function expandContent(element) {
    let parentElement = element.closest('.read-more-content');
    let remainingContent = parentElement.querySelector("#remainingContent");
    let ellipsis = parentElement.querySelector("#ellipsis");
    let link = parentElement.querySelector("#readMoreLink");

    /* let ContentBox = parentElement;
    const ContentBoxInitialHeight = ContentBox.offsetHeight;
    ContentBox.style.height = ContentBoxInitialHeight + 'px'; */

    if (remainingContent.style.display === "none") {
        remainingContent.style.display = "inline";
        ellipsis.style.display = "none";
        //link.style.display = "none";
        link.innerHTML = "Read Less";
        //ContentBox.style.height = ContentBox.scrollHeight + 'px';
    } else {
        remainingContent.style.display = "none";
        ellipsis.style.display = "inline";
        //link.style.display = "inline";
        link.innerHTML = "Read More";
    }
}

// View All Plans
function viewAllPlans(taxonomy, term, subtype, tag, postType, ajaxContainer, allvisible, plansCount, displayName, verticalName) {
    let ajaxUrl = '/wp-admin/admin-ajax.php';
    if (window.location.origin == 'http://localhost:8888') {
        ajaxUrl = '//localhost:8888/consumer-website-wordpress/wp-admin/admin-ajax.php';
    }
    posts_per_page = -1;
    if (allvisible == "true") {
        posts_per_page = plansCount;
    }
    ajaxContainer = "#" + ajaxContainer;
    $.ajax({
        type: 'POST',
        url: ajaxUrl,
        dataType: 'json',
        data: {
            action: 'show_all_plans',
            taxonomy: taxonomy,
            term: term,
            subtype: subtype,
            tag: tag,
            posttype: postType,
            posts_per_page: posts_per_page,
            display_name: displayName,
            vertical_name: verticalName
        },
        beforeSend: function () {
            // Show loader
            $(".tm-loader").show();
        },
        success: function (res) {
            $(ajaxContainer).html(res.html);
            expandableContentHeight();
        },
        complete: function () {
            // Hide loader
            $(".tm-loader").hide();
        },
        error: function (err) {
            console.error(err);
        }
    })
}

let viewAllPlansLinks = document.querySelectorAll('.viewAllPost');

viewAllPlansLinks.forEach(viewAllPlansLink => {
    viewAllPlansLink.addEventListener('click', function (element) {
        let linkElement = element.target.parentElement.parentNode;
        let allvisible = linkElement.dataset.allvisible;

        let section = linkElement.closest('section');

        if (allvisible == "false") {
            let taxonomy = linkElement.dataset.taxonomy;
            let term = linkElement.dataset.term;
            let subtype = linkElement.dataset.subtype;
            let tag = linkElement.dataset.tag;
            let ajaxContainer = linkElement.dataset.ajaxcontainer;
            let postType = linkElement.dataset.posttype;
            let plansCount = linkElement.dataset.planscount;
            let displayName = linkElement.dataset.displayname;
            let verticalName = linkElement.dataset.verticalname;
            viewAllPlans(taxonomy, term, subtype, tag, postType, ajaxContainer, allvisible, plansCount, displayName, verticalName);
            let linkText = linkElement.querySelector(".icon-link span").innerText.replace('All', 'Less');
            linkElement.querySelector(".icon-link").innerHTML = "<span>" + linkText + "</span>" + '<i class="tm-sprite-1 bg-chevron-up-green"></i>';
            let titleTag = linkElement.title;
            let updatedTitleTag = titleTag.replace('All', 'Less');
            linkElement.title = updatedTitleTag;
            linkElement.querySelector(".icon-link").removeAttribute("onclick");
            linkElement.dataset.allvisible = "true";
        } else {
            let taxonomy = linkElement.dataset.taxonomy;
            let term = linkElement.dataset.term;
            let subtype = linkElement.dataset.subtype;
            let tag = linkElement.dataset.tag;
            let ajaxContainer = linkElement.dataset.ajaxcontainer;
            let postType = linkElement.dataset.posttype;
            let plansCount = linkElement.dataset.planscount;
            let displayName = linkElement.dataset.displayname;
            let verticalName = linkElement.dataset.verticalname;
            viewAllPlans(taxonomy, term, subtype, tag, postType, ajaxContainer, allvisible, plansCount, displayName, verticalName);
            let linkText = linkElement.querySelector(".icon-link span").innerText.replace('Less', 'All');
            linkElement.querySelector(".icon-link").innerHTML = "<span>" + linkText + "</span>" + '<i class="tm-sprite-1 bg-chevron-down-green"></i>';
            let titleTag = linkElement.title;
            let updatedTitleTag = titleTag.replace('Less', 'All');
            linkElement.title = updatedTitleTag;
            let eventElement = linkElement.querySelector(".icon-link");
            let eventAction = eventElement.dataset.eventaction;
            let eventCategory = eventElement.dataset.eventcategory;
            let eventLabel = eventElement.dataset.eventlabel;
            eventElement.setAttribute("onclick", "tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "')");
            linkElement.dataset.allvisible = "false";

            if (section) {
                window.scrollTo({
                    top: section.offsetTop - 140,
                    behavior: 'smooth'
                });
            }
        }
    });
});

function tmClickEventData(cta){

    let eventAction = cta.getAttribute('data-eventaction') || '';
    let eventCategory = cta.getAttribute('data-eventcategory') || '';
    let eventLabel = cta.getAttribute('data-eventlabel') || '';
    let ctaDetails = cta.getAttribute('data-ctadetails') || '';
    let ctaValue = cta.getAttribute('data-ctavalue') || '';

    tmClickEvent(eventAction, eventCategory, eventLabel, ctaDetails, ctaValue);
}

function tmClickEvent(eventAction, eventcategory, eventLabel, ctaDetails, ctaValue) {
    const eventParams = {
        event_category: '' + eventcategory + '',
        event_label: '' + eventLabel + ''
    };

    if (ctaDetails !== undefined) {
        eventParams.cta_details = '' + ctaDetails + '';
    }

    if (ctaValue !== undefined) {
        eventParams.cta_value = '' + ctaValue + '';
    }

    gtag('event', '' + eventAction + '', eventParams);
}

// Form events - Get free Advice
var wpcf7Elm = document.querySelector('.wpcf7');
if (wpcf7Elm) {
    wpcf7Elm.addEventListener('wpcf7submit', function (event) {
        let formClasses = event.target.className;
        if (event.detail.status == "mail_sent" && formClasses.includes("get-advice-form")) {
            let vertical = document.getElementsByName('ga-vertical')[0].value;
            let insurer = document.getElementsByName('ga-insurer')[0].value;
            if(document.getElementsByName('ga-city')[0]){
                let city = document.getElementsByName('ga-city')[0].value;
                if (vertical.includes('Health-NH')) {
                    vertical = 'NH-City';
                } else if (vertical.includes('Car-CG')) {
                    vertical = 'CG-City';
                }
                tmClickEvent('Request a call', vertical, insurer, city);
            }else {
                if (vertical.includes('Health-NH-India')) {
                    vertical = 'NH-India';
                } else if (vertical.includes('Car-CG-India')) {
                    vertical = 'CG-India';
                }
                tmClickEvent('Request a call', vertical, insurer);
            }
        }
    }, false);
}

let viewMoreLinks = document.querySelectorAll('.viewMoreLink');

viewMoreLinks.forEach(viewMoreLink => {
    viewMoreLink.addEventListener('click', function (element) {
        let linkElement = this;
        let parentElement = linkElement.parentElement.parentNode.querySelector('.viewMoreContainer');
        let hiddenElements = parentElement.querySelectorAll('.view-more-hidden');

        let section = parentElement.closest('section');

        let eventAction = linkElement.dataset.eventaction;
        let eventCategory = linkElement.dataset.eventcategory;
        let eventLabel = linkElement.dataset.eventlabel;
        let ctadetails = linkElement.dataset.ctadetails;
        let ctavalue = linkElement.dataset.ctavalue;

        if (hiddenElements.length > 0) {
            hiddenElements.forEach(hiddenElement => {
                hiddenElement.classList.add('view-more-visible');
                hiddenElement.classList.remove('view-more-hidden');
            });

            let linkText = linkElement.innerText;
            let updatedLinkText;

            if (linkElement.querySelector(".icon-link")) {
                let titleTag = linkElement.querySelector(".icon-link").title;
                let updatedTitleTag;

                if (titleTag.includes('More')) {
                    updatedTitleTag = titleTag.replace('More', 'Less');
                } else {
                    updatedTitleTag = titleTag;
                }
                linkElement.querySelector(".icon-link").title = updatedTitleTag;
            }

            if (linkText.includes('More')) {
                updatedLinkText = linkText.replace('More', 'Less');
            } else {
                updatedLinkText = linkText;
            }

            let iconLink = linkElement.querySelector(".icon-link");

            if (iconLink) {
                iconLink.innerHTML = '<span>' + updatedLinkText + '</span><i class="tm-sprite-1 bg-chevron-up-green"></i>';
            } else {
                linkElement.querySelector(".wp-block-button__link").innerHTML = '<span>' + updatedLinkText + '</span>';
            }
            if (eventAction && eventCategory && eventLabel) {
                linkElement.removeAttribute("onclick");
            }
        } else {
            if (section && !viewMoreLink.classList.contains('sidebarLink')) {
                if ($(window).width() < 781.98) {
                    topValue = section.offsetTop - 100;
                    window.scrollTo({
                        top: topValue,
                        behavior: 'smooth'
                    });
                } else {
                    topValue = section.offsetTop - 140;
                    window.scrollTo({
                        top: topValue,
                        behavior: 'smooth'
                    });
                }
            } else {
                if ($(window).width() < 781.98) {
                    topValue = section.offsetTop - 100;
                    window.scrollTo({
                        top: topValue,
                        behavior: 'smooth'
                    });
                } else {
                    leftScrollable = document.querySelector(".left-scrollable").clientHeight;
                    leftScrollableTop = document.querySelector(".left-scrollable").offsetTop;
                    topValue = (section.offsetTop - leftScrollableTop) + leftScrollable - 92;
                    window.scrollTo({
                        top: topValue,
                        behavior: 'smooth'
                    });
                }
            }
            let visibleElements = parentElement.querySelectorAll('.view-more-visible');
            visibleElements.forEach(visibleElement => {
                visibleElement.classList.add('view-more-hidden');
                visibleElement.classList.remove('view-more-visible');
            });

            let linkText = linkElement.innerText;
            let updatedLinkText;

            if (linkElement.querySelector(".icon-link")) {
                let titleTag = linkElement.querySelector(".icon-link").title;
                let updatedTitleTag;

                if (titleTag.includes('Less')) {
                    updatedTitleTag = titleTag.replace('Less', 'More');
                } else {
                    updatedTitleTag = titleTag;
                }
                linkElement.querySelector(".icon-link").title = updatedTitleTag;
            }

            if (linkText.includes('Less')) {
                updatedLinkText = linkText.replace('Less', 'More');
            } else {
                updatedLinkText = linkText;
            }

            let iconLink = linkElement.querySelector(".icon-link");

            if (iconLink) {
                iconLink.innerHTML = '<span>' + updatedLinkText + '</span><i class="tm-sprite-1 bg-chevron-down-green"></i>';
            } else {
                linkElement.querySelector(".wp-block-button__link").innerHTML = '<span>' + updatedLinkText + '</span>';
            }
            if (eventAction && eventCategory && eventLabel) {
                linkElement.setAttribute("onclick", "tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "')");
            }
        }
    });
});

function citySearchEvent(){
    if(citySearchInput.value != ''){
        var inputValue = citySearchInput.value;
        var insurer = citySearchInput.getAttribute('data-icname');
        var vertical = citySearchInput.getAttribute('data-vertical');
        if(insurer && vertical && inputValue){
            tmClickEvent('City search query', vertical, insurer, inputValue);
        }
    }
}
const citySearchInput = document.getElementById('locationInput');
if(citySearchInput){
    citySearchInput.addEventListener('input', citySearchEvent);
}

$(document).on('pumBeforeOpen', '.pum', function (event) {
    var popup = event.target;
    var popupForm = $(popup).find('form');
    var formSection = $(popup).find('#formSection');
    var successSection = $(popup).find('#successSection');

    if (popupForm.length) {
        $(popupForm).on('wpcf7mailsent', function () {
            var eventData = pum_event_data(popup);
            tmClickEvent('Website_lead_pop_up_Lead_submitted', eventData.evenCategory, eventData.eventLabel, eventData.ctaDetails, eventData.ctaValue);

            if (formSection.length && successSection.length) {
                $(formSection).hide();
                $(successSection).removeClass("d-none").show();
            }
        });
    }
});

function pum_event_data(element) {
    var eventLabel = $(element).find('.event-label').text();
    var evenCategory = window.location.href;
    var ctaDetails = $(element).find('.gfa-submit').text();
    var ctaValue = 'No';
    var iconList = $(element).find('.popup-icon-list');

    if (iconList.length > 0) {
        ctaValue = 'Yes';
    }

    return {
        eventLabel: eventLabel,
        evenCategory: evenCategory,
        ctaDetails: ctaDetails,
        ctaValue: ctaValue
    };
}

$(document).on('pumAfterOpen', '.pum', function (event) {
    var eventData = pum_event_data(event.target);
    tmClickEvent('Website_lead_pop_up_loaded', eventData.evenCategory, eventData.eventLabel, eventData.ctaDetails, eventData.ctaValue);
});

$(document).on('pumAfterClose', '.pum', function (event) {
    var eventData = pum_event_data(event.target);
    tmClickEvent('Website_lead_pop_up_closed', eventData.evenCategory, eventData.eventLabel, eventData.ctaDetails, eventData.ctaValue);
});

$(document).on('pumAfterClose', '.pum', function (event) {
    var popup = event.target;
    var popupForm = $(popup).find('form')[0];
    var formSection = $(popup).find('#formSection');
    var successSection = $(popup).find('#successSection');

    if (popupForm) {
        popupForm.reset();

        if (formSection.length && successSection.length) {
            $(formSection).show();
            $(successSection).addClass("d-none").hide();
        }
    }
});

function baseVertical() {
    var currentUrl = window.location.href;

    if (currentUrl.includes('health-insurance')) {
        return 'Health';
    } else if (
        currentUrl.includes('car-insurance') ||
        currentUrl.includes('four-wheeler-insurance')
    ) {
        return 'Car';
    } else if (
        currentUrl.includes('bike-insurance') ||
        currentUrl.includes('two-wheeler-insurance')
    ) {
        return 'Bike';
    } else if (currentUrl.includes('life-insurance')) {
        return 'Life';
    } else if (currentUrl === window.location.origin + '/') {
        return 'Homepage';
    } else {
        return 'Other';
    }
}

$(document).on('click', '.tm-event', function () {
    var pageType = baseVertical();
    var pageUrl = window.location.href;
    var ctaName = $(this).text();
    tmClickEvent('Get_Best_Insurance_Quotes_For_clicked', pageType, ctaName + ' Clicked' , pageUrl);
});

// CF7 Form Submission
$('#lead_unit_form_popup').on('shown.bs.modal', function (event) {
    var leadUnitForm = $(event.target).find('form')[0];
 
    if(leadUnitForm){
        leadUnitForm.addEventListener( 'wpcf7mailsent', function( event ) {
            let formSection = $(event.target).parents('.modal-body').find('#formSection');
            let successSection = $(event.target).parents('.modal-body').find('#successSection');
            $(formSection).hide();
            $(successSection).show();
        }, false );
        
        $('#lead_unit_form_popup').on('hidden.bs.modal', function (e) {
            leadUnitForm.reset();
            $(formSection).show();
            $(successSection).hide();
        })
    }
})

$('.wpcf7-form').submit(function() {
    var timestampInput = $(this).find('input[name=ga-timestamp]');
    if(timestampInput.length){
        $(timestampInput).val(Date());
    }
    $(this).find(':input[type=submit]').prop('disabled', true);

    var currentForm = this;

    $(document).on('wpcf7invalid', function(event) {
        if (event.target === currentForm) {
            $('.gfa-submit').prop("disabled", false);
        }
    });
})