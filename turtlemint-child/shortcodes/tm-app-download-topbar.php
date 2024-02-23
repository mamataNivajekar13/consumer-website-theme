<?php
function tmAppDownloadTopbar($atts)
{

    $atts = shortcode_atts(array(), $atts, 'tm_app_download_topbar');

    $pageObject = get_queried_object();

    $pageType = base_vertical();

    if(is_page() || is_single()){
        $pageTitle = get_the_title();
    }elseif(is_404()){
        $pageTitle = 'Error Page';
    }elseif(is_archive()){
        $pageTitle = $pageObject->name;
    }elseif(is_search()){
        $pageTitle = 'Search result page';
    }else{
        $pageTitle = 'Other';
    }

    ob_start(); ?>

    <div class="heading"><i class="tm-sprite-3 bg-moible"></i>
        <p class="mt-0">Easily Organize, Claim and Renew Insurance!</p><span class="topbar-close-button" onclick="tmClickEvent('App Download Banner Close', '<?php echo $pageType; ?>' , '<?php echo $pageTitle; ?>')"><i class="tm-sprite-3 bg-xmark-light-2"></i></span>
    </div>
    <div class="downloads mt-0">
        <div class="bordered small tm-button wp-block-button"><a onclick="tmClickEvent('App Download Banner CTA', '<?php echo $pageType; ?>', '<?php echo $pageTitle; ?>')" class="wp-block-button__link wp-element-button" href="https://turtlemint.onelink.me/b9Hg/n8b3rsrn" target="_blank"><i class="tm-sprite-3 bg-play-store"></i>Download Turtlemint App</a></div>
    </div>

<?php

    $html = ob_get_contents();

    ob_end_clean();

    return $html;
}

add_shortcode('tm_app_download_topbar', 'tmAppDownloadTopbar');
?>