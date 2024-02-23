<?php
function tmIcLeadForm($atts){

	$atts = shortcode_atts( array(
    'form_id' => '',
    'form_html_class' => '',
    'form_title' => ''
  ), $atts, 'tm_ic_lead_form' );

  ob_start();?>

<?php 

  $form_id = $atts['form_id'];
  $form_html_class = $atts['form_html_class'];
  $form_title = $atts['form_title'];

?>

    <section class="wp-block-group alignfull is-layout-flow tm-ic-advice-form mt-0">
      <div class="wp-block-group has-global-padding is-layout-constrained">
        <div class="alignwide">
          <div class="tm-container gradient-bg bordered">
            <?php echo do_shortcode('[contact-form-7 id="'.$form_id.'" html_class="'.$form_html_class.'" title="'.$form_title.'"]'); ?>
            <figure class="wp-block-image size-full tm-form-image"><img loading="lazy" decoding="async" width="301" height="251" src="<?php echo get_stylesheet_directory_uri()."/tm-assets/images/get-advice.webp" ?>" alt="Insurance Expert" class="wp-image-23695" title="Insurance Expert"></figure>
          </div>
        </div>
      </div>
    </section>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_lead_form', 'tmIcLeadForm');
?>