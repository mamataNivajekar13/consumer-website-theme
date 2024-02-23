<?php

/**
* Template Name: Advisor Intro
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <?php
            $block_content_topbar = do_blocks(
                '<!-- wp:template-part {"slug":"topbar","theme":"turtlemint-child","area":"header","className":"tm-topbar"} /-->'
            );
            $block_content_header = do_blocks(
                '<!-- wp:template-part {"slug":"header","theme":"turtlemint-child","tagName":"header", "className":"tm-header"} /-->'
            );
            $block_content_footer = do_blocks(
                '<!-- wp:template-part {"slug":"footer","theme":"turtlemint-child","tagName":"footer"} /-->'
            );
            $block_breadcrumb = do_blocks(
                '<!-- wp:template-part {"slug":"breadcrumb","theme":"turtlemint-child","area":"uncategorized"} /-->'
            );
        ?>
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body <?php body_class(); ?>>

        <?php wp_body_open(); ?>

        <div class="wp-site-blocks">
            <?php echo $block_content_topbar; ?>
            <?php echo $block_content_header; ?>

            <!-- Page Content Start -->

            <?php
                $pincode = isset($_GET["pincode"]) && preg_match('/^[0-9]{6}$/', $_GET["pincode"]) ? htmlspecialchars($_GET["pincode"]) : NULL;
                $vertical_array = array('FW', 'TW', 'Life', 'Health');
                $vertical = isset($_GET["vertical"]) && in_array($_GET["vertical"], $vertical_array) ? htmlspecialchars($_GET["vertical"]) : NULL;
                $offset = isset($_GET["offset"]) ? htmlspecialchars($_GET["offset"]) : "0";
            ?>

            <script>
                function imageSkeletons(element) {
                    var parents = document.querySelectorAll('.tm-loading');
                    parents.forEach(function(parent) {
                        if (parent.contains(element)) {
                        parent.classList.remove('tm-loading');
                        }
                    });
                }
            </script>

                    <div class="alignfull tm-gradient-bg">
                        <?php echo $block_breadcrumb ?>
                        <!-- find advisor section -->
                        <div class="has-global-padding is-layout-constrained">
                            <div class="alignwide find-advisor-section">
                                <div class="left-side">
                                    <h1 class="h1-heading hide-md-down">Find an <span class="tm-highlight-text">Insurance Advisor</span></h1>
                                    <p class="h1-heading hide-md-up">Find an<br><span class="tm-highlight-text">Insurance Advisor</span></p>
                                    <p class="tm-desc">Turtlemint Insurance Advisors provide expert assistance for all your insurance needs <b>Anywhere, Anytime</b>.</p>
                                    <ul class="tm-checklist">
                                        <li>Expert Advice You Can Count On</li>
                                        <li>Trained & Certified Insurance Advisor</li>
                                        <li>Active Claim Support For Any Policy, Any Insurer</li>
                                    </ul>
                                </div>
                                <div class="right-side">
                                    <div class="tm-find-advisor-form">
                                        <div class="tm-find-advisor-form__wraper">
                                            <form class="tm-form" method="GET" action="<?php echo site_url() ?>/insurance-advisor-near-me" id="tmFindAdvisorForm" novalidate>
                                                <div class="form-wrap">
                                                    <div class="tm-form-group filter-form-group">
                                                        <label>Select Insurance Type</label>
                                                        <ul class="filter-select-group">
                                                            <li title="Health Insurance">
                                                                <input type="radio" name="vertical" id="tm-health-insurance" value="Health" data-value="Health" required>
                                                                <label for="tm-health-insurance">
                                                                    <span><i class="icon tm-sprite-3 bg-health" icon-colored="bg-health-colored" icon-default="bg-health"></i></span>Health
                                                                </label>
                                                            </li>
                                                            <li title="Life Insurance">
                                                                <input type="radio" name="vertical" id="tm-life-insurance" value="Life" data-value="Life">
                                                                <label for="tm-life-insurance">
                                                                    <span><i class="icon tm-sprite-3 bg-life" icon-colored="bg-life-colored" icon-default="bg-life"></i></span>Life
                                                                </label>
                                                            </li>
                                                            <li title="Bike Insurance">
                                                                <input type="radio" name="vertical" id="tm-2-wheeler-insurance" value="TW" data-value="Bike">
                                                                <label for="tm-2-wheeler-insurance">
                                                                    <span><i class="icon tm-sprite-3 bg-bike" icon-colored="bg-bike-colored" icon-default="bg-bike"></i></span>Bike
                                                                </label>
                                                            </li>
                                                            <li title="Car Insurance">
                                                                <input type="radio" name="vertical" id="tm-4-wheeler-insurance" value="FW" data-value="Car">
                                                                <label for="tm-4-wheeler-insurance">
                                                                    <span><i class="icon tm-sprite-3 bg-car" icon-colored="bg-car-colored" icon-default="bg-car"></i></span>Car
                                                                </label>
                                                            </li>
                                                        </ul>
                                                        <p class="error-message"></p>
                                                    </div>
                                                </div>

                                                <button class="tm-button">Find Advisor</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- gradient circle -->
                    <div class="alignfull tm-bg-wraper">

                        <!-- statistics section -->
                        <div class="has-global-padding is-layout-constrained">
                            <div class="alignwide tm-advisor-stats-section">
                                <div class="left-side">
                                    <div class="banner-image hide-md-down">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/advisor-intro-banner.webp" alt="Turtlemint Insurance Advisors" title="Turtlemint Insurance Advisors">
                                    </div>
                                    <div class="banner-image hide-md-up">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/advisor-intro-banner-mob.webp" alt="Turtlemint Insurance Advisors" title="Turtlemint Insurance Advisors">
                                    </div>
                                    <p class="h1-heading hide-md-up">Connecting <span class="tm-highlight-text">Customers</span> and <span class="tm-highlight-text">Advisors</span> Across the Country.</p>
                                </div>
                                <div class="right-side">
                                    <p class="h1-heading hide-md-down">Connecting <span class="tm-highlight-text">Customers</span> and <span class="tm-highlight-text">Advisors</span> Across the Country.</p>
                                    <div class="hide-md-down">
                                        <div class="stats-section">
                                            <div class="stat">
                                                <p class="number">2.8 L<span class="d-md-none d-xl-inline-block">akh</span>+</p>
                                                <p class="title">Insurance Advisors</p>
                                            </div>
                                            <div class="stat">
                                                <p class="number">17 K+</p>
                                                <p class="title">Pin Codes</p>
                                            </div>
                                            <div class="stat">
                                                <p class="number">70 L<span class="d-md-none d-xl-inline-block">akh</span>+</p>
                                                <p class="title">Policies Sold</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hide-md-up">
                                        <div class="stats-section ">
                                            <div class="stat">
                                                <p class="number">2.8 Lakh+</p>
                                                <p class="title">Insurance Advisors</p>
                                            </div>
                                            <div class="stat">
                                                <p class="number">17 K+</p>
                                                <p class="title">Pin Codes</p>
                                            </div>
                                            <div class="stat">
                                                <p class="number">70 Lakh+</p>
                                                <p class="title">Policies Sold</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tm-gradient-bg2"></div>

                        <!-- Advisors help section -->
                        <div class="has-global-padding is-layout-constrained advisor-help-section">
                            <div class="alignwide">
                                <h2 class="h1-heading">How does a Turtlemint <span class="tm-highlight-text">Insurance Advisor</span> help you</h2>
                                <div class="help-section">
                                    <div class="image-container">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/unbiased-advise.webp" alt="Unbiased Advice" class="banner-image hide-md-down" height="356" width="527">
                                    </div>
                                    <div class="content">
                                        <p class="heading"><i alt="Unbiased Advice" class="icon tm-sprite-5 bg-unbiased-advise hide-md-up"></i> Empowered Advisors</p>
                                        <p class="desc">Access to a wide network of insurance advisors near you to protect what’s important to you</p>
                                        <ul class="tm-checklist">
                                            <li>Continuous training and upskilling</li>
                                            <li>Well-experienced & equipped with latest products</li>
                                            <li>Digitally enabled expert insurance advisors</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="help-section">
                                    <div class="content">
                                        <p class="heading"><i class="icon tm-sprite-5 bg-certified hide-md-up" alt="Certified Industry Expert"></i>Advice That Puts You First</p>
                                        <p class="desc">Unbiased & quality advice from our trusted advisor can get you the right insurance</p>
                                        <ul class="tm-checklist">
                                            <li>Leverage technology for right advice</li>
                                            <li>Customer-first approach</li>
                                            <li>Instant quotes tailored to your needs</li>
                                        </ul>
                                    </div>
                                    <div class="image-container">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/certified-industry-expert.webp" alt="Certified Industry Expert" class="banner-image hide-md-down" height="350" width="527">
                                    </div>
                                </div>
                                <div class="help-section">
                                    <div class="image-container">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/renewal-n-claim-support.webp" alt="Renewal & Claim Support" class="banner-image hide-md-down" height="350" width="527">
                                    </div>
                                    <div class="content">
                                        <p class="heading"><i class="icon tm-sprite-5 bg-claim-assistance hide-md-up" alt="Renewal & Claim Support"></i>Hassle-Free Claim Assistance</p>
                                        <p class="desc">Complete paperwork and 24x7 claim assistance from our advisors</p>
                                        <ul class="tm-checklist">
                                            <li>Get your claim in short time</li>
                                            <li>Avoid claim rejections</li>
                                            <li>Get maximum assured claim amount*</li>
                                        </ul>
                                        <!-- <small class="d-block mt-4">Please note: Final Claim settlement is at the discretion of the insurers. </small> -->
                                    </div>
                                </div>
                                <div class="help-section">
                                    <div class="content">
                                        <p class="heading"><i class="icon tm-sprite-5 bg-digital-support hide-md-up" alt="Quick Digital SupportUnbiased Advice"></i>Insurance Buying Made Easy</p>
                                        <p class="desc">Making insurance buying process simple with instant quotes from our certified experts</p>
                                        <ul class="tm-checklist">
                                            <li>Option to choose from 45+ top insurers</li>
                                            <li>Expert Advisor at your doorstep</li>
                                            <li>100% digital and paperless process</li>
                                        </ul>
                                    </div>
                                    <div class="image-container">
                                        <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/quick-digital-support.webp" alt="Quick Digital Support" class="banner-image hide-md-down" height="350" width="527">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="alignfull">
                        <div class="has-global-padding is-layout-constrained">
                            <!-- testimonial section -->
                            <div class="alignwide">
                                <div class="tm-testimonial-section">
                                    <p class="h1-heading">Our Customers Love Us!</p>
                                    <div class="tm-testimonial-slider">
                                        <div class="tm-testimonial">
                                            <div class="tm-testimonial__wraper">
                                                <p class="content">Turtlemint’s personalised assistance helped me solve my doubts and find the most suitable policy. Thank you Turtlemint for simplifying insurance</p>
                                                <div class="author">
                                                    <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/mihir.webp" srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/mihir-72x72.webp 767w, <?php echo get_stylesheet_directory_uri() ?>/assets/images/mihir.webp 2000w"  alt="Mihir" title="Mihir" class="profile-image">
                                                    <div class="right-side">
                                                        <div class="review">
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                        </div>
                                                        <p class="author-name">Mihir</p>
                                                        <!-- <p class="author-position">Co-founder</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tm-testimonial">
                                            <div class="tm-testimonial__wraper">
                                                <p class="content">One platform, multiple insurers. Thank you Turtlemint for allowing me to compare the best plans to buy the most suitable policy with ease</p>
                                                <div class="author">
                                                    <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/anupama.webp" srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/anupama-72x72.webp 767w, <?php echo get_stylesheet_directory_uri() ?>/assets/images/anupama.webp 2000w" alt="Anupama" title="Anupama" class="profile-image">
                                                    <div class="right-side">
                                                        <div class="review">
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                        </div>
                                                        <p class="author-name">Anupama</p>
                                                        <!-- <p class="author-position">Co-founder</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tm-testimonial">
                                            <div class="tm-testimonial__wraper">
                                                <p class="content">Thanks to Turtlemint’s online platform buying insurance has become simple. I bought and renewed my policies hassle-free through Turtlemint within minutes</p>
                                                <div class="author">
                                                    <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/ajay.webp" srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/ajay-72x72.webp 767w, <?php echo get_stylesheet_directory_uri() ?>/assets/images/ajay.webp 2000w" alt="Ajay" title="Ajay" class="profile-image">
                                                    <div class="right-side">
                                                        <div class="review">
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                        </div>
                                                        <p class="author-name">Ajay</p>
                                                        <!-- <p class="author-position">Co-founder</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tm-testimonial">
                                            <div class="tm-testimonial__wraper">
                                                <p class="content">I never knew making insurance claims would be so simple. I thank the Turtlemint team for their excellent assistance in claim settlement</p>
                                                <div class="author">
                                                    <img loading="lazy" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/abdul.webp" srcset="<?php echo get_stylesheet_directory_uri() ?>/assets/images/abdul-72x72.webp 767w, <?php echo get_stylesheet_directory_uri() ?>/assets/images/abdul.webp 2000w" alt="Abdul" title="Abdul" class="profile-image">
                                                    <div class="right-side">
                                                        <div class="review">
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                            <i class="tm-sprite-5 bg-star"></i>
                                                        </div>
                                                        <p class="author-name">Abdul</p>
                                                        <!-- <p class="author-position">Co-founder</p> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- text sections -->
                            <div class="alignwide">
                                <div class="tm-content">
                                    <p class="heading">What kind of insurance policies does Turtlemint offer?</p>
                                    <p class="body">Turtlemint offers Car, Bike, Health as well as Life Insurance plans from various top insurers all under one roof through our digitally enabled & certified advisors.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">Who are Turtlemint Advisors?</p>
                                    <p class="body">Turtlemint Insurance Advisors <b>(POSP)</b> offer expert advice to provide the right insurance plan from 45+ insurers based on your needs for health, life, car and bike insurance.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">Are Turtlemint Advisors certified and licensed?</p>
                                    <p class="body">Yes, Turtlemint Insurance Advisors are certified experts and recognized by IRDAI.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">How many locations are these Advisors present in?</p>
                                    <p class="body">Turtlemint Advisors are currently present in 17,000+ Pin Codes in India… and growing.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">Will the advisors help at all steps of the insurance buying process?</p>
                                    <p class="body">Our experts will advise and guide you right from the policy selection process, complete documentation to quick claim settlement assistance.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">Is there any support for claims?</p>
                                    <p class="body">There is full claim support from Turtlemint PoSP Advisor for any policy, any insurer irrespective of where the policy is taken from. Raise claim requests and keep track on-the-go by downloading the <a class="tm-highlight-text" href="https://turtlemint.onelink.me/b9Hg/dg35qnwv" target="_blank" rel="nofollow"><b>Turtlemint App</b></a> and get end to end claim support. You can also file a claim by calling <a class="tm-highlight-text" href="tel:18002660101"><b>1800 266 0101</b></a> or emailing at <a class="tm-highlight-text" href="mailto:claims@turtlemint.com"><b>claims@turtlemint.com</b></a> and submit documents as advised by our claims expert.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="heading">Is home visit service available?</p>
                                    <p class="body">Yes, you can request a face-to-face consultation with our expert advisors.</p>
                                </div>
                                <div class="tm-content">
                                    <p class="body">*Please note: Final Claim settlement is at the discretion of the insurers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            <!-- Page Content End -->

            <?php echo $block_content_footer; ?>

        </div>

        <?php wp_footer(); ?>

        <script type="text/javascript">
                window.tm_vertical_data = <?php echo !(isset($vertical)) ? "'FW'" : "'" . $vertical . "'"; ?>;
                window.tm_offset = <?php echo $offset ?>;
                window.addEventListener("load", async (event) => {
                    <?php if (isset($pincode) && isset($vertical)) { ?>
                        let pincodeData = await getPincodeLocation(<?php echo $pincode ?>)
                        getAdvisorList(pincodeData.pinCode, <?php echo  "'" . $vertical . "', '" . $offset . "'" ?>)
                    <?php }
                    if (isset($vertical)) {  ?>
                        populateVertical()
                    <?php }
                    if (isset($pincode)) { ?>
                        pincodeValidaion()
                        window.tm_pincode_data = <?php echo $pincode;
                    } ?>
                });
            </script>
    </body>
</html>
