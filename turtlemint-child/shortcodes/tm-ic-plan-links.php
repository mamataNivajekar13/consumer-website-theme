<?php
function tmIcPlanLinks($atts){

	$atts = shortcode_atts( array(
    'limit' => 6
  ), $atts, 'tm_ic_plan_links' );

  ob_start();?>

  <?php
  
    $term = get_queried_object();

    if(!$term){
      $health_term_slug = get_query_var( 'health-ic' );
      if($health_term_slug){
        $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
        $insurer_url = get_term_link($term->slug, 'health-insurer');
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
  ?>

  <?php if($totalElements > 0): ?>
    <section class="wp-block-group alignfull is-layout-flow tm-ic-ancillary-links">
      <div class="tm-container bordered">
        <h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"><?php echo ucwords("Check out plans of other insurers"); ?></h2>
        <?php
          if($totalElements > $elementLimit){
            $insurer_ctas_set1 = array_slice($terms, 0, $elementLimit);
            $insurer_ctas_set2 = [];
            $insurer_ctas_set2_terms = array_slice($terms, $elementLimit);

            foreach($insurer_ctas_set2_terms as $term){
              if(get_field('insurer_name', get_term( $term ))){
                $insurer_name = ucwords(get_field('insurer_name', get_term( $term )));
              }else{
                $insurer_name = ucwords(get_term( $term )->name);
              }
              $insurer_link = get_term_link($term);

              $insurer_ctas_set2[] = [
                'insurer_name'  => $insurer_name,
                'insurer_link'  => $insurer_link,
                'vertical_name'  => $vertical_name
              ];
            }
        ?>
        <div class="tm-container has-turtlemint-child-tm-light-yellow-background-color p-0" style="margin-bottom:16px">
          <ul class="tm-cta-list" id="tm-cta-list">
            <?php
              foreach ($insurer_ctas_set1 as $link) {
                echo '<li class="tm-cta-item"><a href="'.$insurer_url.'plans/" title="'.ucwords($link->name.' '.$vertical_name.' Insurance').'">'.ucwords($link->name.' '.$vertical_name.' Insurance').'<i class="tm-sprite-3 bg-chevron-right"></i></a></li>';
              }
            ?>
          </ul>
        </div>
        <div class="cta-links">
          <p class="tm-link d-inline-flex mb-0 sidebarLink" id="tm-view-more-cta-link">
            <a class="icon-link" title="<?php echo ucwords("View more ".$vertical_name." Insurance ctas"); ?>"><span>More Insurers</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
          </p>
        </div>
        <?php } else{ ?>
          <div class="tm-container mb-0 has-turtlemint-child-tm-light-yellow-background-color p-0">
            <ul class="tm-cta-list" id="tm-cta-list">
              <?php
                foreach ($terms as $link) {
                  echo '<li class="tm-cta-item"><a href="'.$insurer_url.'plans/" title="'.ucwords($link->name.' '.$vertical_name.' Insurance').'">'.ucwords($link->name.' '.$vertical_name.' Insurance').'<i class="tm-sprite-3 bg-chevron-right"></i></a></li>';
                }
              ?>
            </ul>
        </div>
        <?php } ?>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
          var viewMoreCtaLink = document.getElementById('tm-view-more-cta-link');
          var insurancectasList = document.getElementById('tm-cta-list');
          var insurerctasSet2 = <?php echo json_encode($insurer_ctas_set2); ?>;

          if(viewMoreCtaLink && insurancectasList && insurerctasSet2){
            function toTitleCase(str) {
                return str.replace(/\b\w/g, function (char) {
                    return char.toUpperCase();
                });
            }

            function createLogoElement(insurerName, insurerLink, verticalName) {
              var outerDiv = document.createElement('li');
              outerDiv.classList = 'tm-cta-item tm-cta-item-shown';

              var ctaLink = document.createElement('a');
              ctaLink.href = insurerLink;
              ctaLink.title = toTitleCase(insurerName + ' ' + verticalName + ' insurance');
              ctaLink.textContent = toTitleCase(insurerName + ' ' + verticalName + ' insurance');

              var ctaIcon = document.createElement('i');
              ctaIcon.classList = 'tm-sprite-3 bg-chevron-right';

              ctaLink.appendChild(ctaIcon);
              outerDiv.appendChild(ctaLink);
              return outerDiv;
            }

            // Event listener for the "View more" link
            viewMoreCtaLink.addEventListener('click', function () {
                var insuranceCompany = insurancectasList.querySelectorAll('.tm-cta-item-shown');

                let linkElement = this;
                let parentElement = linkElement.parentElement.parentNode.querySelector('.tm-cta-list');
                let section = parentElement.closest('section');
                let linkText = linkElement.innerText;
                let updatedLinkText;
                let iconLink = linkElement.querySelector(".icon-link");

                if(insuranceCompany.length > 0){
                  // Remove existing logos
                  insuranceCompany.forEach(function (company) {
                    company.remove();
                  });

                  if (section && !viewMoreCtaLink.classList.contains('sidebarLink')) {
                      if ($(window).width() < 781.98) {
                          topValue = section.offsetTop - 140;
                          window.scrollTo({
                              top: topValue,
                              behavior: 'smooth'
                          });
                      }
                  } else {
                      topValue = section.offsetTop - 100;
                      window.scrollTo({
                          top: topValue,
                          behavior: 'smooth'
                      });
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
                  // Loop through insurer ctas set 2
                  insurerctasSet2.forEach(insurer => {
                    var insurerName = insurer['insurer_name'];
                    var insurerLink = insurer['insurer_link'];
                    var verticalName = insurer['vertical_name'];

                    // Create and append logo element
                    insurancectasList.appendChild(createLogoElement(insurerName, insurerLink, verticalName));
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
  <?php endif; ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_ic_plan_links', 'tmIcPlanLinks');
?>