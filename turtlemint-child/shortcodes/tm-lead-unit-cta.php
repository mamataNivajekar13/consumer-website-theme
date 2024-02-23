<?php
function tmLeadUnitCta($atts){

	$atts = shortcode_atts( array(), $atts, 'tm_lead_unit_cta' );

  ob_start();?>

  <?php
    $vertical_form_shortcode = form_section_validation();
  ?>

  <section class="wp-block-group alignfull is-layout-flow tm-lead-unit-cta">
    <img height="260" width="215" class="floating-img" src="<?php echo get_stylesheet_directory_uri(); ?>/tm-assets/images/girl.webp" loading="lazy" title="Book A Free Consultation" alt="Book A Free Consultation">
    <div class="tm-container gradient-bg-1 mt-0">
      <p class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Feeling unsure about insurance plans? "); ?></p>
      <p class="section-subheading">Our experts can help you make informed decisions</p>
      <ul class="tm-list icons-list<?php if($vertical_form_shortcode == ''): echo ' mb-0'; endif;?>">
        <li><i class="tm-sprite-2 bg-certified-3d"></i>IRDAI certified expert advice</li>
        <li><i class="tm-sprite-2 bg-advise-3d"></i>Free advice</li>
        <li><i class="tm-sprite-2 bg-support-3d"></i>Claim support</li>
      </ul>
      <?php if($vertical_form_shortcode):?>
        <button class="wp-block-button tm-button" style="margin-left: auto;margin-right: auto;margin-bottom:12px"><a data-bs-toggle="modal" data-bs-target="#lead_unit_form_popup" class="wp-block-button__link wp-element-button">Book A Free Consultation</a></button>
        <p class="mb-0" style="text-align: center;">No charges. No spam!</p>
      <?php endif;?>
    </div>
  </section>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_lead_unit_cta', 'tmLeadUnitCta');
?>