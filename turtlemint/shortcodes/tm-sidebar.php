<?php
function tmSidebar($atts){

	$atts = shortcode_atts( array(
    'searchform'=> 'false',
    'popup_cta_title' => 'Get Best Insurance Quotes For'
  ), $atts, 'tm_sidebar' );

  $searchform = $atts['searchform'];
  $popupCtaTitle = $atts['popup_cta_title'];

  ob_start();?>

<div class="tm-sidebar">
  <?php if($searchform == 'true'): ?>
    <?php get_search_form(); ?>
  <?php endif; ?>
  <?php dynamic_sidebar( 'tm_sidebar' ); ?>

  <div class="d-none d-lg-block">
    <?php dynamic_sidebar( 'sidebar_popup'); ?>
  </div>
  <div class="d-lg-none">
    <div class="tm-sidebar__popup-area">
      <button class="sidebar-trigger wp-block-button tm-button"><a class="wp-block-button__link wp-element-button tm-sprite-3-after bg-chevron-filled-circle-dark" data-bs-toggle="modal" data-bs-target="#modalSidebar"><?php echo $popupCtaTitle; ?></a></button>

      <!-- Sidebar modal -->
      <div class="modal tm-modal fade" id="modalSidebar" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <button type="button" class="btn-close tm-sprite-3-before bg-xmark-light" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-content">
            <div class="modal-body">
              <?php dynamic_sidebar( 'sidebar_popup'); ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_sidebar', 'tmSidebar');
?>