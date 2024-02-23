<?php

/**
* Template Name: Advisor List
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
        <style>
            @media (min-width:768px){.advisor-card__wraper .advisor-name{display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;text-overflow:ellipsis}}
        </style>
    </head>

    <body <?php body_class(); ?>>

        <?php wp_body_open(); ?>

        <div class="wp-site-blocks">
            <?php echo $block_content_topbar; ?>
            <?php echo $block_content_header; ?>

            <!-- Page Content Start -->
            <?php
                $pincode = isset($_GET["pincode"]) && preg_match('/^[0-9]{6}$/', $_GET["pincode"]) ? htmlspecialchars($_GET["pincode"]) : NULL;
                $vertical_array = array('FW','TW','Life','Health');
                $vertical = isset($_GET["vertical"]) && in_array($_GET["vertical"], $vertical_array) ? htmlspecialchars($_GET["vertical"]) : NULL ;
                $offset = isset($_GET["offset"]) ? htmlspecialchars($_GET["offset"]) : "0";
                $bodyClasses ='';

                !(isset($pincode) && isset($vertical)) ? $bodyClasses ='tmStopScorll' : $bodyClasses ='';
            ?>

            <script type="text/javascript">
                let bodyClasses = "<?php echo $bodyClasses?>";
                if(bodyClasses){
                    document.body.classList.add(bodyClasses);
                }
            </script>

            <!-- pincode popup -->
            <div class="tm-popup <?php echo !(isset($pincode) && isset($vertical)) ? "show restrict-event disableCloseBtn" : ""; ?>" id="pincodePopup">
                <div class="tm-popup-dialog" role="document">
                    <div class="content-wrap">
                        <div class="tm-popup-content">
                            <div class="tm-popup-header">
                                <button type="button" class="close" onclick="closePopup('pincodePopup')">
                                    <span class="icon"></span>
                                </button>
                            </div>
                            <div class="tm-popup-body">
                                <div class="popup-icon">
                                   <i class="tm-sprite-8 tm-location-2"></i>
                                </div>
                                <p class="popup-heading">Find an advisor near you!</p>
                                <p class="popup-subheading">Enter your Pincode so we can show you advisors in your area</p>
                                <form class="tm-form" id="pincodeForm">
                                    <div class="form-wrap">
                                        <div class="tm-form-group filter-form-group <?php echo (isset($vertical)) ? "d-none" : "" ?>">
                                            <label for="pincode">Select Insurance Type</label>
                                            <ul class="filter-select-group">
                                                <li title="Health Insurance">
                                                    <input type="radio" name="tm-insurance-type" id="tm-health-insurance" <?php echo $vertical=="Health" ? "checked" : ""; ?> value="Health">
                                                    <label for="tm-health-insurance">
                                                        <span>
                                                        <i class="icon tm-sprite-3 bg-health" id="<?php echo $vertical=="Health" ? "health2-icon" : "bg-health"; ?>" icon-colored="bg-health-colored" icon-default="bg-health"></i></span>Health
                                                    </label>
                                                </li>
                                                <li title="Life Insurance">
                                                    <input type="radio" name="tm-insurance-type" id="tm-life-insurance" <?php echo $vertical=="Life" ? "checked" : ""; ?> value="Life">
                                                    <label for="tm-life-insurance">
                                                        <span><i class="icon tm-sprite-3 bg-life" id="<?php echo $vertical=="life" ? "bg-life-colored" : "bg-life"; ?>" icon-colored="bg-life-colored" icon-default="bg-life"></i></span>Life
                                                    </label>
                                                </li>
                                                <li title="Bike Insurance">
                                                    <input type="radio" name="tm-insurance-type" id="tm-2-wheeler-insurance" <?php echo $vertical=="TW" ? "checked" : ""; ?> value="TW">
                                                    <label for="tm-2-wheeler-insurance">
                                                        <span><i class="icon tm-sprite-3 bg-bike" id="<?php echo $vertical=="TW" ? "bg-bike-colored" : "bg-bike"; ?>" icon-colored="bg-bike-colored" icon-default="bg-bike"></i></span>Bike
                                                    </label>
                                                </li>
                                                <li title="Car Insurance">
                                                    <input type="radio" name="tm-insurance-type" id="tm-4-wheeler-insurance" <?php echo $vertical=="FW" ? "checked" : ""; ?> <?php echo $vertical== null ? "checked" : ""; ?> value="FW">
                                                    <label for="tm-4-wheeler-insurance">
                                                        <span>
                                                        <i class="icon tm-sprite-3 bg-car" id="<?php if($vertical=="FW"){echo "bg-car-colored";} elseif($vertical== null){echo "bg-car-colored";} else{echo "bg-car";} ?>" icon-colored="bg-car-colored" icon-default="bg-car"></i></span>Car
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tm-form-group">
                                            <label for="pincode">Enter Pin code</label>
                                            <div class="single-input-group pincode-input-group">
                                                <input class="required" autofocus type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[0]?>">
                                                <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[1]?>">
                                                <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[2]?>">
                                                <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[3]?>">
                                                <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[4]?>">
                                                <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]" value="<?php echo $pincode[5]?>">
                                            </div>
                                            <p class="error-message"></p>
                                        </div>
                                        <!-- <div class="location-wraper">add loading class here
                                            <p class="location-name location-name-skeleton"></p>
                                            <p class="location-name d-none">Navada, Patna, Bihar</p>
                                        </div> -->
                                    </div>

                                    <button class="tm-button" <?php echo !(isset($pincode)) ? 'disabled':''; ?> >Submit</button>
                                    <!-- <p class="or-text">or</p> -->
                                </form>
                            </div>
                            <div class="tm-popup-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alignfull">
                <div class="has-global-padding is-layout-constrained">

                    <!-- Locate Advisor -->
                    <div style="height: 80px; background-color:#F3F3F3;" class="alignfull locator-bg">
                    </div>
                    <div class="alignwide locator-section-main tm-loading" style="margin-bottom: 29px; margin-top: -44px !important;"><!-- add loading class here -->
                        <div class="row ">
                            <div class="col-md-12 tm-loading">
                                <div class="row locator-section tm-filters-skeleton">
                                    <div class="left-side">
                                        <div class="tm-select-dropdown skeleton-dropdown">
                                            <div class="tm-select-value">
                                                <div class="icon-container"><img loading="lazy"  src="" alt="" class="icon"></div> <span class="title"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <div class="tm-pincode-section">
                                            <p class="pincode-title"></p>
                                            <a class="pincode"></a>
                                        </div>
                                        <a class="locate-me-link"><img loading="lazy"  class="icon" src=""><span></span></a>
                                    </div>
                                </div>
                                <!-- filters content -->
                                <div class="row locator-section">
                                    <div class="left-side">
                                        <div class="tm-select-dropdown">
                                            <div class="tm-select-value" data-value="FW" onclick="tmSelectDropdown(this)"><i alt="4 Wheeler Insurance" class="icon tm-sprite-3 bg-health"></i> <span class="title">Car</span></div>
                                            <div class="tm-select-options">
                                                <div title="4 Wheeler Insurance" class="tm-select-option <?php echo $vertical=="FW" ? "selected" : ""; ?>" data-value="FW" onclick="tmSelectDropdown(this, true)" data-icon="bg-car">
                                                    <i alt="4 Wheeler Insurance" class="icon tm-sprite-3 bg-car"></i>
                                                    <span class="title">Car</span>
                                                </div>
                                                <div title="2 Wheeler Insurance" class="tm-select-option <?php echo $vertical=="TW" ? "selected" : ""; ?>" data-value="TW" onclick="tmSelectDropdown(this, true)" data-icon="bg-bike">
                                                    <i alt="2 Wheeler Insurance" class="icon tm-sprite-3 bg-bike"></i>
                                                    <span class="title">Bike</span>
                                                </div>
                                                <div title="Life Insurance" class="tm-select-option <?php echo $vertical=="Life" ? "selected" : ""; ?>" data-value="Life" onclick="tmSelectDropdown(this, true)" data-icon="bg-life">
                                                    <i alt="Life Insurance" class="icon tm-sprite-3 bg-life"></i>
                                                    <span class="title">Life</span>
                                                </div>
                                                <div title="Health Insurance" class="tm-select-option <?php echo $vertical=="Health" ? "selected" : ""; ?>" data-value="Health" onclick="tmSelectDropdown(this, true)" data-icon="bg-health">
                                                    <i alt="Health Insurance" class="icon tm-sprite-3 bg-health"></i>
                                                    <span class="title">Health</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <div class="tm-pincode-section">
                                            <p class="pincode-title">Pincode</p>
                                            <a class="pincode tm-arrow-right" id="pincode-filter-input" onclick="openPopup('pincodePopup')"><?php echo $pincode ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alignwide advisor-list-wraper">
                        <?php echo $block_breadcrumb ?>
                        <!-- Advisors headings -->
                        <div class="container tm-heading-container tm-preloader tm-loading"> <!-- add loading class here -->
                            <!-- skeleton -->
                            <p class="tm-h1-regular tm-section-heading heading-skeleton"></p>
                            <p class="tm-body tm-grey-text mb-0 tm-section-subheading subheading-skeleton"></p>
                            <!-- headings -->
                            <span class="hide-md-down ">
                                <h1 class="tm-h1-regular tm-section-heading"><span class="tm-h1-bold tm-highlight-text agent-count-js">45 Insurance Advisors</span> Near You</h1>
                            </span>
                            <span class="hide-md-up">
                                <h1 class=" tm-h1-regular tm-section-heading"><span class="tm-h1-bold tm-highlight-text agent-count-js">45 Insurance Advisors</span> Near You</h1>
                            </span>
                            <p class="tm-body tm-grey-text mb-0 tm-section-subheading">Get a free consultation and home visit from our Insurance Advisors</p>
                        </div>

                        <!-- advisor cards main container -->
                        <div class="container advisors-list-section tm-preloader tm-loading"><!-- add loading class here -->

                            <!-- cards skeleton -->
                            <div class="tm-advisor-list tm-skeleton">
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- advisor cards -->
                            <div class="tm-advisor-list" id="firstFoldList">
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/kaleen.webp" alt="kaleen">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Kaleen Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/munna.webp" alt="Munna Bhaiya">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Munna Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/advisor-placeholder.webp" alt="Guddu Bhaiya">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Guddu Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="advisor-steps-outer tm-preloader tm-loading"><!-- add loading class here -->
                            <!-- advice steps skeleton-->
                            <div class="container tm-advice-steps-container tm-steps-skeleton">
                                <div class="tm-advice-steps-container__wraper">
                                    <div class="tm-headings">
                                        <div class="left-side">
                                            <p class="tm-h1-medium tm-section-heading heading-skeleton"></p>
                                            <p class="tm-body-regular tm-grey-text mb-0 tm-section-subheading subheading-skeleton"></p>
                                        </div>
                                        <div class="right-side hide-md-down">
                                            <a class="tm-link"></a>
                                        </div>
                                    </div>
                                    <div class="tm-scrollbar-mob-horizontal tm-advise-steps">
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="">
                                            </div>
                                            <div class="step-num"></div>
                                            <div class="step-connector"></div>
                                            <p class="content"></p>
                                            <p class="content2"></p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="">
                                            </div>
                                            <div class="step-num"></div>
                                            <div class="step-connector"></div>
                                            <p class="content"></p>
                                            <p class="content2"></p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="">
                                            </div>
                                            <div class="step-num"></div>
                                            <div class="step-connector"></div>
                                            <p class="content"></p>
                                            <p class="content2"></p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="">
                                            </div>
                                            <div class="step-num"></div>
                                            <div class="step-connector"></div>
                                            <p class="content"></p>
                                            <p class="content2"></p>
                                        </div>
                                    </div>
                                    <div class="hide-md-up link-container">
                                        <a class="tm-link"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- advice steps -->
                            <div class="container tm-advice-steps-container">
                                <div class="tm-advice-steps-container__wraper">
                                    <div class="tm-headings">
                                        <div class="left-side">
                                            <p class="tm-h1-medium tm-section-heading">What To Expect</p>
                                            <p class="tm-body-regular tm-grey-text mb-0 tm-section-subheading">4 quick steps to getting the right insurance advice from our experts</p>
                                        </div>
                                        <div class="right-side hide-md-down">
                                            <a href="<?php echo site_url() ?>/find-insurance-advisor" class="tm-link arrow-right-filled" onclick="gtag('event', 'DPL-DP_Intro-Linkclicks', {event_category:'LinkClicks',event_label: 'Link-click More about Turtlemint Advisors'});">More about Turtlemint Advisors</a>
                                        </div>
                                    </div>
                                    <div class="tm-scrollbar-mob-horizontal tm-advise-steps">
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/step-1.webp" alt="Step 1">
                                            </div>
                                            <div class="step-num">Step 1</div>
                                            <div class="step-connector"></div>
                                            <p class="content">
                                            Search an insurance advisor near you
                                            </p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/step-2.webp" alt="Step 2">
                                            </div>
                                            <div class="step-num">Step 2</div>
                                            <div class="step-connector"></div>
                                            <p class="content">
                                            Get the perfect match as per your needs
                                            </p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/step-3.webp" alt="Step 3">
                                            </div>
                                            <div class="step-num">Step 3</div>
                                            <div class="step-connector"></div>
                                            <p class="content">
                                            Request a consultation
                                            </p>
                                        </div>
                                        <div class="tm-advise-step">
                                            <div class="image-container">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/step-4.webp" alt="Step 4">
                                            </div>
                                            <div class="step-num">Step 4</div>
                                            <div class="step-connector"></div>
                                            <p class="content">
                                            Get customized insurance plan
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hide-md-up link-container">
                                        <a href="<?php echo site_url() ?>/find-insurance-advisor" class="tm-link arrow-right-filled" onclick="gtag('event', 'DPL-DP_Intro-Linkclicks', {event_category:'LinkClicks',event_label: 'Link-click More about Turtlemint Advisors'});">More about Turtlemint Advisors</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- advisor cards main container -->
                        <div class="container advisors-list-section tm-preloader tm-loading"><!-- add loading class here -->

                            <!-- cards skeleton -->
                            <div class="tm-advisor-list tm-skeleton">
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- skeleton card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card tm-card-skeleton">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="" alt="">
                                            </div>
                                            <p class="tm-h2-bold advisor-name"></p>
                                            <p class="tm-body tm-grey-text advisor-location"></p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title"></p>
                                                    <p class="tm-body tm-grey-text stat-subtitle"></p>
                                                </div>
                                            </div>
                                            <a class="tm-button"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- advisor cards -->
                            <div class="tm-advisor-list" id="lastFoldList">
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/kaleen.webp" alt="kaleen">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Kaleen Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/munna.webp" alt="Munna Bhaiya">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Munna Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- advisor card -->
                                <div class="tm-advisor-wrap">
                                    <div class="advisor-card">
                                        <div class="advisor-card__wraper">
                                            <div class="advisor-image">
                                                <img loading="lazy"  src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/guddu.webp" alt="Guddu Bhaiya">
                                            </div>
                                            <p class="tm-h2-bold advisor-name">Guddu Bhaiya</p>
                                            <p class="tm-body tm-grey-text advisor-location">Andheri West, Mumbai</p>
                                            <div class="row tm-stats">
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">5 Years</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Experience</p>
                                                </div>
                                                <div class="col-6 stat">
                                                    <p class="tm-h2-regular stat-title">700+</p>
                                                    <p class="tm-body tm-grey-text stat-subtitle">Policies Sold</p>
                                                </div>
                                            </div>
                                            <a class="tm-button" onclick="openPopup('getInTouchPopup')">Get In Touch</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- Loader -->
                    <div class="alignwide advisors-list-section d-none" id="paginationLoader"><!-- add loading class here -->
                        <!-- cards skeleton -->
                        <div class="tm-advisor-list tm-skeleton" style="display: grid;">
                            <!-- skeleton card -->
                            <div class="tm-advisor-wrap">
                                <div class="advisor-card tm-card-skeleton">
                                    <div class="advisor-card__wraper">
                                        <div class="advisor-image">
                                            <img loading="lazy"  src="" alt="">
                                        </div>
                                        <p class="tm-h2-bold advisor-name"></p>
                                        <p class="tm-body tm-grey-text advisor-location"></p>
                                        <div class="row tm-stats">
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                        </div>
                                        <a class="tm-button"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- skeleton card -->
                            <div class="tm-advisor-wrap">
                                <div class="advisor-card tm-card-skeleton">
                                    <div class="advisor-card__wraper">
                                        <div class="advisor-image">
                                            <img loading="lazy"  src="" alt="">
                                        </div>
                                        <p class="tm-h2-bold advisor-name"></p>
                                        <p class="tm-body tm-grey-text advisor-location"></p>
                                        <div class="row tm-stats">
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                        </div>
                                        <a class="tm-button"></a>
                                    </div>
                                </div>
                            </div>
                            <!-- skeleton card -->
                            <div class="tm-advisor-wrap">
                                <div class="advisor-card tm-card-skeleton">
                                    <div class="advisor-card__wraper">
                                        <div class="advisor-image">
                                            <img loading="lazy"  src="" alt="">
                                        </div>
                                        <p class="tm-h2-bold advisor-name"></p>
                                        <p class="tm-body tm-grey-text advisor-location"></p>
                                        <div class="row tm-stats">
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                            <div class="col-6 stat">
                                                <p class="tm-h2-regular stat-title"></p>
                                                <p class="tm-body tm-grey-text stat-subtitle"></p>
                                            </div>
                                        </div>
                                        <a class="tm-button"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advisor List - Empty State  -->
                    <div class="alignwide" id="empty-screen-wrap">
                        <div class="tm-empty-list">
                            <div class="image-container">
                                <img loading="lazy"  height="160" width="160" src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/empty-advisor-list.webp" alt="No Advisors Found">
                            </div>
                            <p class="tm-h2-bold tm-heading">We are recruiting advisors in your area</p>
                            <p class="tm-subheading">Submit your contact details to get free advise from Turtlemint insurance experts.</p>
                            <a class="tm-button large" onclick="gtag('event', 'GIT-Btn_click-'+sessionStorage.getItem('tm_vertical_data')+'-Get in touch', {'event_category': 'No_DPL-Page', 'event_label': 'GIT-'+ JSON.parse(sessionStorage.getItem('tm_pincode_data')).pinCode }); openPopup('ESGetInTouchPopup');">Get in touch</a>
                            <div class="call-details">
                                <p class="title">Call us to get advise</p>
                                <a href="tel:02262919080" class="tm-link" onclick="gtag('event', 'DPL-Inbound_call-Linkclicks', {'event_category': 'No_DPL-Page', 'event_label': 'Link-click 022-62919080'});"><i class="tm-sprite-8 bg-call-2"></i>022-62919080</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- success popup -->
            <div class="tm-popup" id="tmSuccessPopup">
                <div class="tm-popup-dialog" role="document">
                    <div class="content-wrap">
                        <div class="tm-popup-content">
                            <div class="tm-popup-header">
                                <button type="button" class="close" onclick="closePopup('tmSuccessPopup')">
                                    <span class="tm-sprite-3 bg-xmark"></span>
                                </button>

                            </div>
                            <div class="tm-popup-body">
                                <div class="popup-icon">
                                    <i class="tm-sprite-8 bg-checkmark-green-2"></i>
                                </div>
                                <p class="popup-heading">Success!</p>
                                <p class="popup-subheading">Our Insurance advisor <span id="tm_advisor_name">Kaleen bhaiya</span> will contact you shortly</p>
                            </div>
                            <div class="tm-popup-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- get in touch popup -->
            <div class="tm-popup" id="getInTouchPopup">
                <div class="tm-popup-dialog" role="document">
                    <div class="content-wrap">
                        <div class="tm-popup-content">
                            <div class="tm-popup-header">
                                <button type="button" class="close" onclick="closePopup('getInTouchPopup')">
                                    <span class="tm-sprite-3 bg-xmark"></span>
                                </button>

                            </div>
                            <div class="tm-popup-body">
                                <div class="popup-icon">
                                    <i class="tm-sprite-8 bg-profile" alt="profile"></i>
                                </div>
                                <p class="popup-heading">Just a bit more about you!</p>
                                <p class="popup-subheading">Please share your details so that our advisor can connect with you.</p>
                                <form class="tm-form style2" id="getInTouchForm" novalidate>
                                    <div class="form-wrap">
                                        <div class="tm-form-group">
                                            <label for="tm-name">Name</label>
                                            <input class="required" name="tm-name" id="tm-name" type="text" oninput="this.value=this.value.replace(/[^a-zA-Z ]/g,'')">
                                            <!-- onkeydown="return /[a-z ]/i.test(event.key) -->
                                            <p class="error-message"></p>
                                        </div>
                                        <div class="tm-form-group">
                                            <label for="tm-mobileNo">Mobile No.</label>
                                            <div class="prefix">
                                                <span class="input-group-prefix">+91</span>
                                                <input class="required" type="number" name="tm-mobileNo" id="tm-mobileNo">
                                            </div>
                                            <p class="error-message"></p>
                                        </div>

                                        <p class="error-message text-center" id="maxLimitMsg">You have exceeded the maximum limit for submitting the form. Try again after 30 minutes.</p>
                                        <button class="tm-button" type="submit" disabled>Submit</button>
                                        <p class="form-note hide-custom-up">You agree to be contacted on WhatsApp by submitting details.</p>
                                        <p class="form-note hide-custom-down">You agree to be contacted on WhatsApp by<br>submitting details.</p>
                                    </div>
                                </form>
                            </div>
                            <div class="tm-popup-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty Screen get in touch popup -->
            <div class="tm-popup" id="ESGetInTouchPopup">
                <div class="tm-popup-dialog" role="document">
                    <div class="content-wrap">
                        <div class="tm-popup-content">
                            <div class="tm-popup-header">
                                <button type="button" class="close" onclick="closePopup('ESGetInTouchPopup')">
                                    <span class="tm-sprite-3 bg-xmark"></span>
                                </button>

                            </div>
                            <div class="tm-popup-body">
                                <?php echo do_shortcode('[contact-form-7 id="23414" title="No DP Listing"]') ?>
                            </div>
                            <div class="tm-popup-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OTP popup -->
            <div class="tm-popup" id="tmOtpPopup">
                <div class="tm-popup-dialog-outer">
                    <div class="tm-popup-dialog" role="document">
                        <div class="content-wrap">
                            <div class="tm-popup-content">
                                <div class="tm-popup-header">
                                    <button type="button" class="close" onclick="closePopup('tmOtpPopup')">
                                        <span class="tm-sprite-3 bg-xmark"></span>
                                    </button>

                                </div>
                                <div class="tm-popup-body">
                                    <div class="popup-icon">
                                        <i class="tm-sprite-8 bg-message"></i>
                                    </div>
                                    <p class="popup-heading">OTP Verification</p>
                                    <p class="popup-subheading">We’ve sent a verification code to your mobile<br><b id='otpPhone'>+91 8962995991</b></p>
                                    <form class="tm-form" id="tmOtpForm">
                                        <div class="form-wrap">
                                            <div class="tm-form-group">
                                                <label for="otp">OTP</label>
                                                <div class="single-input-group otp-input-group">
                                                    <input class="required" autofocus type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                    <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                    <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                    <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                    <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                    <input class="required" type="number" min="0" max="9" maxlength="1" oninput="this.value=this.value.toString()[0]">
                                                </div>
                                                <p class="error-message"></p>
                                            </div>
                                            <p class="resend-timer"><span class="resend-text">Resend code in</span> <span class="timer" id="countdowntimer"></span></p>
                                        </div>

                                        <button class="tm-button" disabled>Submit</button>
                                    </form>
                                </div>
                                <div class="tm-popup-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                sessionStorage.setItem('tm_vertical_data',<?php echo !(isset($vertical)) ? "'FW'" : "'".$vertical."'"; ?>)
                window.tm_offset = <?php echo $offset; ?>;
                window.addEventListener("load", async (event) => {
                <?php if (isset($pincode) && isset($vertical)) { ?>
                        let pincodeData = await getPincodeLocation(<?php echo $pincode ?>)
                        getAdvisorList(pincodeData.pinCode, <?php echo  "'" . $vertical . "', '" . $offset . "'" ?>)
                <?php } if(isset($vertical)) {  ?>
                        populateVertical()
                <?php } if(isset($pincode)) { ?>
                    sessionStorage.setItem("tm_pincode_data",JSON.stringify({"pinCode": <?php echo $pincode; ?>}))
                    pincodeValidaion()
                <?php } ?>
                });
                sessionStorage.getItem('tm_user_name') ? document.getElementById('tm-name').value = sessionStorage.getItem('tm_user_name') : '';
                sessionStorage.getItem('tm_user_phone') ? document.getElementById('tm-mobileNo').value = sessionStorage.getItem('tm_user_phone') : '';
                sessionStorage.getItem('tm_user_name') && sessionStorage.getItem('tm_user_phone') ? $('#getInTouchForm [type=submit]').removeAttr('disabled') : '';

                <?php if (!(isset($pincode) && isset($vertical)) ){ ?>
                window.addEventListener('DOMContentLoaded', (event) => {
                    gtag('event', 'Popup', {
                        'event_category': 'DPL_Popup',
                        'event_label': 'Pincode_Popup'
                    });
                });
                <?php } ?>

                document.querySelectorAll("#empty-screen-wrap a.tm-button.large").forEach(function(element) {
                element.addEventListener("click", function() {
                    document.querySelectorAll('.tmdatetime').forEach(function(elem) {
                        elem.value = Date();
                    });
                    document.querySelectorAll('.verticalnodp').forEach(function(elem) {
                        elem.value = "<?php echo $vertical ?>";
                    });
                });
            });
            </script>
            <!-- Page Content End -->

            <?php echo $block_content_footer; ?>

        </div>

        <?php wp_footer(); ?>
    </body>
</html>

