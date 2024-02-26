<?php
function tmPdpExclusions($atts){

	$atts = shortcode_atts( array(
    'limit' => '16'
  ), $atts, 'tm_pdp_exclusions' );

  ob_start();?>

  <?php
    $currentVertical = strtolower(base_vertical());
    $vertical_name_category = tm_event_category();

    if(is_single()){
      if(get_query_var( 'health-insurer' )){
        $tax_slug = (get_query_var( 'health-insurer' ));
        $term_queried_object = get_term_by('slug', $tax_slug, 'health-insurer');
      }
      if($term_queried_object){
        if(get_field('insurer_name', $term_queried_object)){
          $insurer_title = ucwords(get_field('insurer_name', $term_queried_object));
        }else{
          $insurer_title = ucwords($term_queried_object->name);
        }
      }
      $tm_plan_data = tm_plan_data();
      $title = $tm_plan_data['plan_title'];
    }elseif(is_tax()){
      $term_queried_object = get_queried_object();
      if(get_field('insurer_name', $term_queried_object)){
        $title = ucwords(get_field('insurer_name', $term_queried_object));
      }else{
          $title = ucwords($term_queried_object->name);
      }
    }

    // Data
    $pdp_exclusions_list = $tm_plan_data['pdp_exclusions_list'];
    
    $elementLimit = $atts['limit'];

    if(isset($pdp_exclusions_list)){
      $totalElements = count($pdp_exclusions_list);
      $set1 = array_slice($pdp_exclusions_list, 0, $elementLimit);
      $set2 = array_slice($pdp_exclusions_list, $elementLimit);
    }
  ?>

    <?php if(isset($pdp_exclusions_list) && $totalElements > 0):?>
      <section id="exclusions" class="highlight-section tm-container bordered wp-block-group alignfull is-layout-flow tm-gradient-top-right tm-gradient-md-top-left red highlight-section" id="exclusions">
        <div class="tm-container__content wp-block-columns flex-column-reverse flex-md-row">
          <div class="wp-block-column" style="flex-basis: 80%;">
            <?php echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size"> Exclusions of '.ucwords($insurer_title.' '.$title.' '.$currentVertical).' Insurance Policy</h2>'; ?>
            <?php echo '<p>'.ucwords($insurer_title.' '.$title).' plan does not cover the following:</p>'; ?>
          </div>
          <div class="wp-block-column text-md-end text-start" style="flex-basis: 20%;">
            <i class="tm-sprite-2 bg-exclusion-3d"></i>
          </div>
        </div>

        <?php if($totalElements > $elementLimit): ?>

          <div class="exclusions-content-list" id="pdp-exclusions-list">

            <?php foreach ($set1 as $exclusion): ?>

              <div class="exclusions-content-list__item">
                <i class="tm-sprite-1 bg-xmark-red"></i>
                <?php 
                  if(isset($exclusion['title'])){
                    echo '<p class="title mb-0">'.ucwords($exclusion['title']).'</p>';
                  }
                ?>
              </div>
            
            <?php endforeach;?>

          </div>

          <div class="cta-links">
            <p class="tm-link mb-0 d-inline-flex" id="tm-view-more-exclusions" data-eventaction="View all exclusions" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_title; ?>" data-ctadetails="<?php echo $title; ?>">
              <a class="icon-link" onclick="tmClickEvent('View all exclusions', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_title; ?>', '<?php echo $title; ?>')" title="<?php echo ucwords("Read more ".$title." ".$currentVertical." Insurance exclusions"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a>
            </p>
          </div>

        <?php else: ?>


          <div class="exclusions-content-list">

            <?php foreach ($pdp_exclusions_list as $exclusion): ?>

              <div class="exclusions-content-list__item">
                <i class="tm-sprite-1 bg-xmark-red"></i>
                <?php 
                  if(isset($exclusion['title'])){
                    echo '<p class="title mb-0">'.ucwords($exclusion['title']).'</p>';
                  }
                ?>
              </div>

            <?php endforeach;?>

          </div>

        <?php endif; ?>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var viewMoreCtaLink = document.getElementById('tm-view-more-exclusions');
          var pdpExclusionList = document.getElementById('pdp-exclusions-list');
          var exclusionSet2 = <?php echo json_encode($set2); ?>;

          if (viewMoreCtaLink && pdpExclusionList && exclusionSet2) {
            function toTitleCase(str) {
              return str.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
              });
            }

            function createExclusionElement(exclusionTitle) {
              var outerDiv = document.createElement('div');
              outerDiv.classList = 'exclusions-content-list__item exclusions-content-list__item-shown';

              var exclusionIconElement = document.createElement('i');
              exclusionIconElement.classList = 'tm-sprite-1 bg-xmark-red';

              var exclusionTitleElement = document.createElement('p');
              exclusionTitleElement.classList = 'title mb-0';
              exclusionTitleElement.innerHTML = toTitleCase(exclusionTitle);

              outerDiv.appendChild(exclusionIconElement);
              outerDiv.appendChild(exclusionTitleElement);
              return outerDiv;
            }

            // Event listener for the "View more" link
            viewMoreCtaLink.addEventListener('click', function() {
              var pdpExclusion = pdpExclusionList.querySelectorAll('.exclusions-content-list__item-shown');

              let linkElement = this;
              linkElement.querySelector(".icon-link").removeAttribute("onclick");
              let parentElement = linkElement.parentElement.parentNode.querySelector('.exclusions-content-list');
              let section = parentElement.closest('section');
              let linkText = linkElement.innerText;
              let updatedLinkText;
              let iconLink = linkElement.querySelector(".icon-link");

              if (pdpExclusion.length > 0) {
                // Remove existing logos
                pdpExclusion.forEach(function(company) {
                  company.remove();
                });
                if (section && !viewMoreCtaLink.classList.contains('sidebarLink')) {
                  if ($(window).width() < 781.98) {
                    topValue = section.offsetTop - 140;
                    window.scrollTo({
                      top: topValue,
                      behavior: 'smooth'
                    });
                  }else{
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

                  let eventAction = linkElement.dataset.eventaction;
                  let eventCategory = linkElement.dataset.eventcategory;
                  let eventLabel = linkElement.dataset.eventlabel;
                  let ctaDetails = linkElement.dataset.ctadetails;
                  let ctaValue = linkElement.dataset.ctavalue;

                  if (eventAction && eventCategory && eventLabel) {
                      let onclickValue = "tmClickEvent('" + eventAction + "', '" + eventCategory + "', '" + eventLabel + "'";
                  
                      if (ctaDetails) {
                          onclickValue += ", '" + ctaDetails + "'";
                      }
                  
                      if (ctaValue) {
                          onclickValue += ", '" + ctaValue + "'";
                      }
                  
                      onclickValue += ")";

                      linkElement.querySelector(".icon-link").setAttribute("onclick", onclickValue);
                  }

                } else {
                  updatedLinkText = linkText;
                }

                if (iconLink) {
                  iconLink.innerHTML = '<span>' + updatedLinkText + '</span><i class="tm-sprite-1 bg-chevron-down-green"></i>';
                } else {
                  linkElement.querySelector(".wp-block-button__link").innerHTML = '<span>' + updatedLinkText + '</span>';
                }

              } else {
                // Loop through set 2
                exclusionSet2.forEach(exclusion => {
                  var exclusionTitle = exclusion['title'];
                  var exclusionDesc = exclusion['desc'];

                  // Create and append logo element
                  pdpExclusionList.appendChild(createExclusionElement(exclusionTitle));
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

add_shortcode('tm_pdp_exclusions', 'tmPdpExclusions');
?>