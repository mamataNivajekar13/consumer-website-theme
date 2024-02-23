<script type="text/javascript">
    function load_youtube_embed() {
        var youtubeContainers = document.querySelectorAll('.youtube-container');
        if(youtubeContainers){
            youtubeContainers.forEach(function (youtubeContainer) {
                var placeholder = youtubeContainer.querySelector('.youtube-placeholder');

                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var iframe = document.createElement('iframe');
                        iframe.src = placeholder.getAttribute('data-src');
                        iframe.width = '100%';
                        iframe.height = '400';
                        iframe.frameBorder = '0';
                        iframe.allowFullscreen = true;
                        youtubeContainer.appendChild(iframe);
                        observer.disconnect();
                    }
                    });
                });

                // Start observing the placeholder
                observer.observe(placeholder);
            });
        }
    }
    document.onreadystatechange = () => {
        if (document.readyState === "complete") {
            //console.log("Page is loaded.");
            load_youtube_embed();
            let total_temp_styles = []
            //let temp_styles = document.getElementById("tm-critical-temp");
            $('style.tm-critical-temp').each(
                function(){
                   this.remove()
                }
            )

            // Topbar - start
            if ($(window).width() < 767.98) {
                var topbarElement = document.querySelector("header.tm-topbar");

                if(topbarElement){
                    $('.tm-hamburger-menu').css("top", "-111px");
                    function hideNav() {
                        $('.tm-hamburger-menu').css("top", "0px");
                        $("header.tm-topbar").addClass("hidden");
                        $("header.tm-topbar .tm-topbar-app-download").css("opacity", "0");
                        $("header.tm-topbar .tm-topbar-app-download").css("visibility", "hidden");
                        //$(".tm-header").removeClass("topbar-is-visible").addClass("topbar-is-hidden");
                    }
                    function showNav() {
                        $("header.tm-topbar .tm-topbar-app-download").css("opacity", "1");
                        $("header.tm-topbar .tm-topbar-app-download").css("visibility", "visible");
                        $("header.tm-topbar").removeClass("hidden");
                        //$(".tm-header").removeClass("topbar-is-hidden").addClass("topbar-is-visible");
                    }
                    $('.topbar-close-button').click(function () {
                        hideNav();
                        sessionStorage.setItem('topbarClosed', 'true');
                    });

                    if (sessionStorage.getItem('topbarClosed') == 'true') {
                        window.setTimeout(hideNav, 0);
                    } else {
                        showNav();
                    }

                    /* var previousScroll = 0;

                    $(window).scroll(function () {

                        $(".tm-topbar").css("position", "fixed");

                        if (sessionStorage.getItem('topbarClosed') != 'true') {
                            var currentScroll = $(this).scrollTop();

                            if (currentScroll > 0 && currentScroll < $(document).height() - $(window).height()) {

                                if (currentScroll > previousScroll) {
                                    window.setTimeout(hideNav, 300);

                                } else {
                                    window.setTimeout(showNav, 300);
                                }

                                previousScroll = currentScroll;
                            }else{
                                $(".tm-topbar").css("position", "sticky");
                            }
                        }

                    }); */
                }
            }
            // Topbar - end
        }
    };
    function handlePageshow(event) {
      if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
        var locationInput = document.getElementById("locationInput");
        if(locationInput){
            locationInput.value = '';
            locationInput.removeAttribute('disabled');
            locationInput.removeAttribute('style');
            locationInput.classList.remove('gm-err-autocomplete');
            locationInput.placeholder = 'Search Location';
        }
      }
    }
    window.addEventListener('pageshow', handlePageshow);
</script>

<!-- modal -->
<div class="modal tm-modal fade widget-modal_policy_cancellation" id="policy_cancellation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <button type="button" class="btn-close tm-sprite-3-before bg-xmark-light" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-content">
            <div class="modal-body">
                <?php dynamic_sidebar( 'policy_cancellation'); ?>
            </div>
        </div>
    </div>
</div>

<!-- Lead Unit Form -->
<?php

    $vertical_form_shortcode = form_section_validation();

    $pattern = '/([a-z_]+)="([^"]*)"/i';

    preg_match_all($pattern, $vertical_form_shortcode, $matches, PREG_SET_ORDER);

    $shortcode_attributes = array();

    foreach ($matches as $match) {
        $attribute = $match[1];
        $value = $match[2];
        $shortcode_attributes[$attribute] = $value;
    }

    if($vertical_form_shortcode):
?>
    <div class="modal tm-modal fade tm-form-popup" id="lead_unit_form_popup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <button type="button" class="btn-close tm-sprite-3-before bg-xmark-light" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-content">
                <div class="modal-body">
                    <div id="formSection">
                        <div class="headingSection">
                            <?php
                                if(isset($shortcode_attributes["title"])){
                                    echo '<p class="section-heading has-turtlemint-child-tm-x-large-font-size">'.$shortcode_attributes["title"].'</p>';
                                }
                                if(isset($shortcode_attributes["description"])){
                                    echo '<p class="section-subheading">'.$shortcode_attributes["description"].'</p>';
                                }
                            ?>
                        </div>
                        <div class="wp-block-columns is-layout-flex mb-0 lead_unit_form_popup_columns">
                            <div class="wp-block-column is-layout-flow" style="max-width: 65%;">
                                <?php echo do_shortcode($vertical_form_shortcode); ?>
                            </div>
                            <div class="wp-block-column is-layout-flow" style="max-width: 35%;">
                                <img loading="lazy" height="215" width="174" class="form-img d-none d-md-block" src="<?php echo get_stylesheet_directory_uri(); ?>/tm-assets/images/expert.webp" loading="lazy" title="Expert" alt="Expert">
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id="successSection">
                        <p class="text-center section-heading has-turtlemint-child-tm-x-large-font-size">Now sit back and relax!</p>
                        <p class="section-subheading text-center mb-0" style="font-weight: 600;">Our advisor will reach out to you shortly!</p>
                        <img loading="lazy" height="231" width="261" class="form-img" src="<?php echo get_stylesheet_directory_uri(); ?>/tm-assets/images/expert-2.webp" loading="lazy" title="Expert" alt="Expert">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- TODO - Comment this after QA -->
<!-- <script src="<?php /* echo get_stylesheet_directory_uri() */ ?>/assets/js/find-advisor-widget.js" type="text/javascript" defer></script> -->