<?php
function tmPartners($atts){

	$atts = shortcode_atts( array(
    'limit' => 10,
    'vertical' => '',
    'columns' => '',
    'classes' => '',
  ), $atts, 'tm_partners' );

  ob_start();?>

  <?php

    $vertical = $atts['vertical'];
    $columns = $atts['columns'];

    $carInsurers = get_terms( array(
      'taxonomy' => 'car-insurer',
      'hide_empty' => false,
    ) );

    $lifeInsurers = [
      [
        "insurer" => "Aviva",
        "url"     => "/life-insurance-companies/aviva-life-insurance/",
        "logo"    => "Aviva_Insurance.webp"
      ],
      [
        "insurer" => "Bajaj Allianz",
        "url"     => "/life-insurance-companies/bajaj-allianz-life-insurance/",
        "logo"    => "Bajaj-Allianz-Insurance.webp"
      ],
      [
        "insurer" => "Birla Sun",
        "url"     => "/life-insurance-companies/birla-sun-life-insurance/",
        "logo"    => "Birla_Sunlife_Insurance.webp"
      ],
      [
        "insurer" => "Canara HSBC OBC",
        "url"     => "/life-insurance-companies/canara-hsbc-obc-life-insurance/",
        "logo"    => "Canara_HSBC_Insurance.webp"
      ],
      [
        "insurer" => "Edelweiss Tokio",
        "url"     => "/life-insurance-companies/edelweiss-tokio-life-insurance/",
        "logo"    => "Edelweis_Tokio_Insurance.webp"
      ],
      [
        "insurer" => "Exide",
        "url"     => "/life-insurance-companies/exide-life-insurance/",
        "logo"    => "Exide-insurance.webp"
      ],
      [
        "insurer" => "Future Generali",
        "url"     => "/life-insurance-companies/future-generali-life-insurance/",
        "logo"    => "Future-Generali-Insurance.webp"
      ],
      [
        "insurer" => "HDFC",
        "url"     => "/life-insurance-companies/hdfc-life-insurance/",
        "logo"    => "HDFC_Life_Insurance.webp"
      ],
      [
        "insurer" => "ICICI Prudential",
        "url"     => "/life-insurance-companies/icici-prudential-life-insurance/",
        "logo"    => "ICICI_Pru_Insurance.webp"
      ],
      [
        "insurer" => "IDBI Federal",
        "url"     => "/life-insurance-companies/idbi-federal-life-insurance/",
        "logo"    => "IDBI_Fed_Insurance.webp"
      ],
      [
        "insurer" => "Indiafirst",
        "url"     => "/life-insurance-companies/indiafirst-life-insurance/",
        "logo"    => "indiafirst-insurance.webp"
      ],
      [
        "insurer" => "Kotak",
        "url"     => "/life-insurance-companies/kotak-life-insurance/",
        "logo"    => "Kotak-Insurance.webp"
      ],
      [
        "insurer" => "LIC of India",
        "url"     => "/life-insurance-companies/lic-of-india/",
        "logo"    => "lic-india_Insurance.webp"
      ],
      [
        "insurer" => "Max",
        "url"     => "/life-insurance-companies/max-life-insurance/",
        "logo"    => "Maxlife-insurance.webp"
      ],
      [
        "insurer" => "National",
        "url"     => "/life-insurance-companies/national-insurance-life-insurance/",
        "logo"    => "National-Insurance.webp"
      ],
      [
        "insurer" => "Oriental",
        "url"     => "/life-insurance-companies/oriental-life-insurance/",
        "logo"    => "Oriental-Insurance.webp"
      ],
      [
        "insurer" => "PNB Metlife",
        "url"     => "/life-insurance-companies/pnb-metlife/",
        "logo"    => "Pnb_Metlife_Insurance.webp"
      ],
      [
        "insurer" => "Reliance",
        "url"     => "/life-insurance-companies/reliance-general-insurance/",
        "logo"    => "Reliance-Insurance.webp"
      ],
      [
        "insurer" => "Reliance Nippon",
        "url"     => "/life-insurance-companies/reliance-nippon-life-insurance/",
        "logo"    => "reliance-nippon-insurance.webp"
      ],
      [
        "insurer" => "Sahara",
        "url"     => "/life-insurance-companies/sahara-life-insurance/",
        "logo"    => "sahara-insurance.webp"
      ],
      [
        "insurer" => "Shriram",
        "url"     => "/life-insurance-companies/shriram-life-insurance/",
        "logo"    => "Shriram_insurance.webp"
      ],
      [
        "insurer" => "TATA AIA",
        "url"     => "/life-insurance-companies/tata-aia-life-insurance/",
        "logo"    => "TATA_AIA_Insurance.webp"
      ]
    ];

    $healthInsurers = get_terms( array(
      'taxonomy' => 'health-insurer',
      'hide_empty' => false,
    ) );

    $bikeInsurers = get_terms( array(
      'taxonomy' => 'bike-insurer',
      'hide_empty' => false,
    ) );
    
    $elementLimit = $atts['limit'];
    $classes = $atts['classes'];

    $templateName = get_page_template_slug();

    if(is_single() || $templateName == 'page-e-tier'){
      $baseVertical = base_vertical();
      $vertical = strtolower($baseVertical);
    }
  ?>

  <?php if($vertical != 'other'):?>

    <section class="tm-container mb-0 mt-0<?php if($classes): echo ' '.$classes; endif; ?>">
      <?php
        if (is_single() || $templateName == 'page-e-tier') {
          echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size text-center mt-0">' . ucwords($baseVertical . ' Insurance companies') . '</h2>';
        }else{
          echo '<h2 class="section-heading has-turtlemint-child-tm-x-large-font-size text-center mt-0">' . ucwords('Our Partners') . '</h2>';
        }
      ?>
      <div class="wp-block-group alignfull is-layout-flow tm-insurance-companies tm-partners">
        <div class="wp-block-group has-global-padding is-layout-constrained">
          <div class="alignwide">
            <div>

            <!-- Navigation -->
            <?php if ($vertical == ""){?>

            <ul class="nav nav-pills" id="pills-tab" role="tablist">

              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-bike-tab" data-bs-toggle="pill" data-bs-target="#pills-bike" type="button" role="tab" aria-controls="pills-bike" aria-selected="true">Bike</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-car-tab" data-bs-toggle="pill" data-bs-target="#pills-car" type="button" role="tab" aria-controls="pills-car" aria-selected="false">Car</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-health-tab" data-bs-toggle="pill" data-bs-target="#pills-health" type="button" role="tab" aria-controls="pills-health" aria-selected="false">Health</button>
              </li>

              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-life-tab" data-bs-toggle="pill" data-bs-target="#pills-life" type="button" role="tab" aria-controls="pills-life" aria-selected="false">Life</button>
              </li>
            </ul>

            <!-- Content -->
            <div class="tab-content" id="pills-tabContent">

              <div class="tab-pane fade show active" id="pills-bike" role="tabpanel" aria-labelledby="pills-bike-tab" tabindex="0">
                <?php
                  get_template_part( 'parts/list', 'ic-2', [
                    'terms' => $bikeInsurers,
                    'elementLimit' => $elementLimit,
                    'vertical_name' => 'Bike',
                    'columns' => $columns
                  ]);
                ?>
              </div>

              <div class="tab-pane fade" id="pills-car" role="tabpanel" aria-labelledby="pills-car-tab" tabindex="0">
                <?php
                    get_template_part( 'parts/list', 'ic-2', [
                      'terms' => $carInsurers,
                      'elementLimit' => $elementLimit,
                      'vertical_name' => 'Car',
                      'columns' => $columns
                    ]);
                ?>
              </div>

              <div class="tab-pane fade" id="pills-health" role="tabpanel" aria-labelledby="pills-health-tab" tabindex="0">
                <?php
                  get_template_part( 'parts/list', 'ic-2', [
                    'terms' => $healthInsurers,
                    'elementLimit' => $elementLimit,
                    'vertical_name' => 'Health',
                    'columns' => $columns
                  ]);
                ?>
              </div>

              <div class="tab-pane fade" id="pills-life" role="tabpanel" aria-labelledby="pills-life-tab" tabindex="0">
                <?php
                    get_template_part( 'parts/list', 'ic', [
                      'terms' => $lifeInsurers,
                      'elementLimit' => $elementLimit,
                      'vertical_name' => 'Life',
                      'columns' => $columns
                    ]);
                ?>
              </div>

            </div>

            <?php  
            }
            elseif ($vertical == 'bike') {
              get_template_part( 'parts/list', 'ic-2', [
                'terms' => $bikeInsurers,
                'elementLimit' => $elementLimit,
                'vertical_name' => 'Bike',
                'columns' => $columns
              ]);
            }
            elseif ($vertical == 'car') {
              get_template_part( 'parts/list', 'ic-2', [
                'terms' => $carInsurers,
                'elementLimit' => $elementLimit,
                'vertical_name' => 'Car',
                'columns' => $columns
              ]);
            }
            elseif ($vertical == 'health') {
              get_template_part( 'parts/list', 'ic-2', [
                'terms' => $healthInsurers,
                'elementLimit' => $elementLimit,
                'vertical_name' => 'Health',
                'columns' => $columns
              ]);
            }
            elseif ($vertical == 'life') {
              get_template_part( 'parts/list', 'ic', [
                'terms' => $lifeInsurers,
                'elementLimit' => $elementLimit,
                'vertical_name' => 'Life',
                'columns' => $columns
              ]);
            }
            ?>

            </div>
          </div>
        </div>
      </div>
    </section>

  <?php endif; ?>
  
  <?php
  
  $html = ob_get_contents();

  ob_end_clean();

  return $html;
}

add_shortcode('tm_partners', 'tmPartners');
?>