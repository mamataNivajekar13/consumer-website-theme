<?php
function tmCopyrightYear($atts){

    $copyRightYear = date("Y");
    return '<span>©'.$copyRightYear.'</span>';
}

add_shortcode('tm_copyright_year', 'tmCopyrightYear');
?>