<?php
function tmPopup($atts){
	$atts = shortcode_atts( array(
        'popup' => '',
        'trigger_classes' => '',
        'trigger_text' => 'Click Here'
    ), $atts, 'tm_popup' );

    $popup =  str_replace(' ', '_', strtolower($atts['popup']));
    $trigger_text =  $atts['trigger_text'];
    $trigger_classes =  $atts['trigger_classes'];

  ob_start();?>

<?php
    if($trigger_text){?>
        <p class="<?php echo $trigger_classes ?>"><a <?php if($popup != ''){echo 'data-bs-toggle="modal" data-bs-target="#'.$popup.'"'; } ?>><?php echo $trigger_text; ?></a></p>
    <?php
    }
?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_popup', 'tmPopup');
?>