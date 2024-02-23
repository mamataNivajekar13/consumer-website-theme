<?php
function tmInsuranceCompanies($atts){

	$atts = shortcode_atts( array(
    'limit' => 6,
    'type' => ''
  ), $atts, 'tm_insurance_companies' );

  ob_start();?>

  <?php
    $type = $atts['type'];

    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
      }
      $car_term_slug = get_query_var( 'car-ic' );
      if($car_term_slug) {
        $term = get_term_by( 'slug', $car_term_slug, 'car-insurer' );
      }
    }

    $taxonomy_slug = $term->taxonomy;

    $term_id = $term->term_id;

    /* Theme Settings - start */
    $theme_settings_verticals = get_field('verticals', 'option');
    $vertical_name = null;
    foreach ($theme_settings_verticals as $theme_settings_vertical) {
        $vertical_taxonomy_slug = $theme_settings_vertical['vertical_taxonomy_slug'];

        if($vertical_taxonomy_slug == $taxonomy_slug){
          $vertical_name = ucwords($theme_settings_vertical['display_vertical_name_as']);
          $vertical_name_category = ucwords($theme_settings_vertical['display_vertical_name_as']);
        }
    }
    /* Theme Settings - end */
    $convertedVerticalName = str_replace(' ', '-', strtolower($vertical_name));

    $terms = get_terms( array(
      'taxonomy' => $convertedVerticalName.'-insurer', /* Vertical Slug Change */
      'hide_empty' => false,
      'exclude' => [$term_id]
   ) );
    $elementLimit = $atts['limit'];
    $totalElements = count($terms);

    if(get_field('insurer_name', $term)){
      $insurer_display_name = ucwords(get_field('insurer_name', $term));
    }else{
      $insurer_display_name = ucwords($term->name);
    }
    global $template;
    $templateName = basename($template);
    $cta_value = null;
    if($templateName == 'ic-network-hospitals.php'){
      $vertical_name_category = 'NH-India';
    }elseif($templateName == 'tm-nh-hospitals-list.php'){
      $vertical_name_category = 'NH-City';
      $cta_value = ", '".get_query_var( 'health-ic-city' )."'";
    }elseif($templateName == 'tm-cg-network.php') {
      $vertical_name_category = 'CG-India';
    }elseif($templateName == 'tm-cg-city-list.php'){
      $vertical_name_category = 'CG-City';
      $cta_value = ", '".get_query_var( 'car-cg-city' )."'";
    }else{
      $vertical_name_category = tm_event_category();
    }
  ?>

  <?php if($terms):?>
    <section class="wp-block-group alignfull is-layout-flow tm-insurance-companies">
      <div class="tm-container blurred-bg bordered">
        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords($vertical_name." Insurance companies similar to ".$insurer_display_name); ?></h2>

        <?php
          if($totalElements > $elementLimit){
            $insurer_companies_set1 = array_slice($terms, 0, $elementLimit);
            $insurer_companies_set2 = [];
            $insurer_companies_set2_terms = array_slice($terms, $elementLimit);

            foreach($insurer_companies_set2_terms as $term){
              $insurer_logo = get_field('insurer_logo', get_term( $term ));
              if(get_field('insurer_name', get_term( $term ))){
                $insurer_name = ucwords(get_field('insurer_name', get_term( $term )));
              }else{
                $insurer_name = ucwords(get_term( $term )->name);
              }
              $insurer_link = get_term_link($term);

              $insurer_companies_set2[] = [
                'insurer_name'  => $insurer_name,
                'insurer_link'  => $insurer_link,
                'insurer_logo'  => $insurer_logo,
                'vertical_name'  => $vertical_name,
                'vertical_name_category'  => $vertical_name_category,
                'current_insurer'   => $insurer_display_name,
                'current_city'  => str_replace([' ', ',', '\''], '', $cta_value)
              ];
            }
        ?>
        <div class="tm-insurance-companies-list" id="tm-insurance-companies-list" style="margin-bottom:16px">
          <?php foreach($insurer_companies_set1 as $child_term_id): ?>
              <?php 
                $insurer_logo = get_field('insurer_logo', get_term( $child_term_id ));
                if(get_field('insurer_name', get_term( $child_term_id ))){
                  $ic_display_name = ucwords(get_field('insurer_name', get_term( $child_term_id )));
                }else{
                  $ic_display_name = ucwords(get_term( $child_term_id )->name);
                }
              ?>
            <div class="tm-insurance-company">
              <div class="tm-insurance-company__wrapper">
              <a class="tm-insurance-company__logo" href="<?php echo get_term_link($child_term_id); ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" onclick="tmClickEvent('Other Insurer Clicked', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>', '<?php echo $ic_display_name; ?>' <?php if($cta_value): echo $cta_value; endif; ?>)">
                  <?php if($insurer_logo):?>
                    <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo $insurer_logo; ?>">
                  <?php else:?>
                    <div class="tm-insurance-company__placeholder"></div>
                  <?php endif;?>
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="cta-links">
          <p class="tm-link d-inline-flex mb-0 sidebarLink" id="tm-view-more-link">
            <a class="icon-link" title="<?php echo ucwords("View more ".$vertical_name." Insurance companies"); ?>"><span>More Insurers</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
          </p>
        </div>
        
        <?php } else{ ?>
          <div class="tm-insurance-companies-list">
            <?php foreach($terms as $child_term_id): ?>
              <?php 
                $insurer_logo = get_field('insurer_logo', get_term( $child_term_id ));
                if(get_field('insurer_name', get_term( $child_term_id ))){
                  $ic_display_name = ucwords(get_field('insurer_name', get_term( $child_term_id )));
                }else{
                  $ic_display_name = ucwords(get_term( $child_term_id )->name);
                }
              ?>
              <div class="tm-insurance-company">
                <div class="tm-insurance-company__wrapper">
                <a class="tm-insurance-company__logo" href="<?php echo get_term_link($child_term_id); ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" onclick="tmClickEvent('Other Insurer Clicked', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>', '<?php echo $ic_display_name; ?>' <?php if($cta_value): echo $cta_value; endif; ?>)">
                  <?php if($insurer_logo):?>
                    <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo $insurer_logo; ?>">
                  <?php else:?>
                    <div class="tm-insurance-company__placeholder"></div>
                  <?php endif;?>
                </a>
                </div>
              </div>
            <?php endforeach; ?>
        </div>
        <?php } ?>
      </div>
      
      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
          var viewMoreLink = document.getElementById('tm-view-more-link');
          var insuranceCompaniesList = document.getElementById('tm-insurance-companies-list');
          var insurercompaniesSet2 = <?php echo json_encode($insurer_companies_set2); ?>;

          if(viewMoreLink && insuranceCompaniesList && insurercompaniesSet2){
            function toTitleCase(str) {
              return str.replace(/\w\S*/g, function (txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
              });
            }

            function createLogoElement(insurerName, insurerLink, insurerLogo, verticalName, verticalNameCategory, currentInsurer, currentCity) {
              var outerDiv = document.createElement('div');
              outerDiv.classList = 'tm-insurance-company tm-insurance-company-shown';

              var logoWrapper = document.createElement('div');
              logoWrapper.className = 'tm-insurance-company__wrapper';

              var logoLink = document.createElement('a');
              logoLink.className = 'tm-insurance-company__logo';
              logoLink.href = insurerLink;
              logoLink.title = toTitleCase(insurerName + ' ' + verticalName + ' insurance');

              if(currentCity){
                logoLink.onclick = function() {
                tmClickEvent('Other Insurer Clicked', verticalNameCategory, currentInsurer, insurerName, currentCity);
              };
              }else{
                logoLink.onclick = function() {
                tmClickEvent('Other Insurer Clicked', verticalNameCategory, currentInsurer, insurerName);
              };
              }

              var logoImg = document.createElement('img');
              logoImg.loading = 'lazy';
              logoImg.src = insurerLogo;
              logoImg.height = '85';
              logoImg.title = toTitleCase(insurerName + ' ' + verticalName + ' insurance');
              logoImg.alt = toTitleCase(insurerName + ' ' + verticalName + ' insurance logo');

              logoLink.appendChild(logoImg);
              logoWrapper.appendChild(logoLink);
              outerDiv.appendChild(logoWrapper);
              return outerDiv;
            }

            // Event listener for the "View more" link
            viewMoreLink.addEventListener('click', function () {
                var insuranceCompany = insuranceCompaniesList.querySelectorAll('.tm-insurance-company-shown');

                let linkElement = this;
                let parentElement = linkElement.parentElement.parentNode.querySelector('.tm-insurance-companies-list');
                let section = parentElement.closest('section');
                let linkText = linkElement.innerText;
                let updatedLinkText;
                let iconLink = linkElement.querySelector(".icon-link");

                if(insuranceCompany.length > 0){
                  // Remove existing logos
                  insuranceCompany.forEach(function (company) {
                    company.remove();
                  });

                  if (section && !viewMoreLink.classList.contains('sidebarLink')) {
                      if ($(window).width() < 781.98) {
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
                      }
                  }
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

                  if (iconLink) {
                      iconLink.innerHTML = '<span>' + updatedLinkText + '</span><i class="tm-sprite-1 bg-chevron-down-green"></i>';
                  } else {
                      linkElement.querySelector(".wp-block-button__link").innerHTML = '<span>' + updatedLinkText + '</span>';
                  }

                }else{
                  // Loop through insurer companies set 2
                  insurercompaniesSet2.forEach(insurer => {
                    var insurerName = insurer['insurer_name'];
                    var insurerLink = insurer['insurer_link'];
                    var insurerLogo = insurer['insurer_logo'];
                    var verticalName = insurer['vertical_name'];
                    var verticalNameCategory = insurer['vertical_name_category'];
                    var currentInsurer = insurer['current_insurer'];
                    var currentCity = insurer['current_city'];

                    // Create and append logo element
                    insuranceCompaniesList.appendChild(createLogoElement(insurerName, insurerLink, insurerLogo, verticalName, verticalNameCategory, currentInsurer, currentCity));
                  });

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

                  if (iconLink) {
                      iconLink.innerHTML = '<span>' + updatedLinkText + '</span><i class="tm-sprite-1 bg-chevron-up-green"></i>';
                    } else {
                      linkElement.querySelector(".wp-block-button__link").innerHTML = '<span>' + updatedLinkText + '</span>';
                  }

                }

            });
          }
        });
      </script>

    </section>
  <?php endif;?>
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_insurance_companies', 'tmInsuranceCompanies');
?>