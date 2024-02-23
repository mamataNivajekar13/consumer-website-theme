<?php
// FAQ Group
function tmFaqGroup($atts, $content = null)
{

    $atts = shortcode_atts(array(
        'group_slug' => 'home-faqs',
        'title' => ''
    ), $atts, 'tm_faq_group');

    ob_start();

    $group_slug = $atts['group_slug'];
    $group_title = $atts['title'];

    $args = array(
        'tax_query' => array(
            array(
                'taxonomy' => 'tm_group',
                'field' => 'slug',
                'terms' => array($group_slug)
            ),
        ),
        'post_type' => 'tm_faqs',
        'post_status' => 'publish',
        'posts_per_page' => -1
    );
    $loop = new WP_Query($args);

    if ($loop->have_posts()) :
?>

        <div class="tm-section-faq__wraper">
            <?php if($group_title): ?>
                <p class="has-turtlemint-child-large-font-size tm-weight-medium mt-0 mb-40 faq-group-title"><?php echo $group_title ?></p>
            <?php endif; ?>
            <div class="tm-accordion" id="tmAccordion-<?php echo $group_slug  ?>">

                <?php
                while ($loop->have_posts()) : $loop->the_post();

                    $faq_id = get_the_ID();
                    $faq_title = get_the_title();
                    $faq_content = get_the_content();
                    if ($loop->current_post == 0 && !is_paged()) : ?>
                        <div class="tm-accordion-item">
                            <p class="tm-accordion-header" id="heading-<?php echo $faq_id ?>">
                                <button class="tm-sprite-3-after bg-chevron-up tm-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $faq_id ?>" aria-expanded="false" aria-controls="collapse-<?php echo $faq_id ?>">
                                    <?php echo $faq_title ?>
                                </button>
                            </p>
                            <div id="collapse-<?php echo $faq_id ?>" class="tm-accordion-collapse collapse show" aria-labelledby="heading-<?php echo $faq_id ?>" data-bs-parent="#tmAccordion-<?php echo $group_slug  ?>">
                                <div class="tm-accordion-body">
                                    <div class="tm-accordion-body__wraper">
                                        <?php echo $faq_content ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>

                        <div class="tm-accordion-item">
                            <p class="tm-accordion-header" id="heading-<?php echo $faq_id ?>">
                                <button class="tm-sprite-3-after bg-chevron-down tm-accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $faq_id ?>" aria-expanded="false" aria-controls="collapse-<?php echo $faq_id ?>">
                                    <?php echo $faq_title ?>
                                </button>
                            </p>
                            <div id="collapse-<?php echo $faq_id ?>" class="tm-accordion-collapse collapse" aria-labelledby="heading-<?php echo $faq_id ?>" data-bs-parent="#tmAccordion-<?php echo $group_slug  ?>">
                                <div class="tm-accordion-body">
                                    <div class="tm-accordion-body__wraper">
                                        <?php echo $faq_content ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php
                    endif;
                endwhile;
                ?>

            </div>
        </div>

        <script type="text/javascript">
        // FAQ
        if(document.getElementById('tmAccordion-<?php echo $group_slug ?>')){
            document.getElementById('tmAccordion-<?php echo $group_slug ?>').addEventListener('hide.bs.collapse', event => {
                $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-up').addClass('bg-chevron-down')
            })
            document.getElementById('tmAccordion-<?php echo $group_slug ?>').addEventListener('show.bs.collapse', event => {
                $(event.target).prev('.tm-accordion-header').find('.tm-accordion-button').removeClass('bg-chevron-down').addClass('bg-chevron-up')
            })
        }
        </script>

    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

<?php $html = ob_get_contents();

    ob_end_clean();

    return $html;
}
add_shortcode('tm_faq_group', 'tmFaqGroup');

// FAQs Section
function tmFaqs($atts, $content = null)
{

    $atts = shortcode_atts(array(), $atts, 'tm_faqs');

    ob_start(); ?>

    <?php
        // Regular expression to match group_slug values
        $pattern = '/group_slug="([^"]+)"/';

        // Initialize an empty array to store the extracted values
        $groupSlugs = array();

        // Use preg_match_all to find all matches in the input string
        if (preg_match_all($pattern, $content, $matches)) {
            // $matches[1] contains the captured values
            $groupSlugs = $matches[1];
        }

        $groupTaxonomy = "tm_group";

        $faqSchema = '<!-- FAQ Schema - Start -->
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "FAQPage",
                "mainEntity": [';

        $entities = [];

        foreach ($groupSlugs as $groupSlug){
            $faqArgs = array(
                'post_type' => 'tm_faqs',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $groupTaxonomy,
                        'field' => 'slug',
                        'terms' => $groupSlug,
                    ),
                ),
            );

            $faqQuery = new WP_Query($faqArgs);

            if($faqQuery->have_posts()){
        
                        while ($faqQuery->have_posts()){
                            $faqQuery->the_post();
        
                            $question = get_the_title();
                            $answer = esc_attr(wp_strip_all_tags(get_the_content()));

                            if($answer != '' && $question != ''){
                                $question = htmlspecialchars($question, ENT_QUOTES, 'UTF-8');
                                $answer = htmlspecialchars($answer, ENT_QUOTES, 'UTF-8');
                                $entities[] = '{
                                    "@type": "Question",
                                    "name": "'.$question.'",
                                    "acceptedAnswer": {
                                    "@type": "Answer",
                                    "text": "'.$answer.'"
                                    }
                                }';
                            }
                        }
            }
            wp_reset_postdata();
        }

        $faqSchema .= implode(', ', $entities);
                
        $faqSchema .=' ]
            }
        </script>
        <!-- FAQ Schema - End -->';

        add_action( 'wp_head', function() use ( $faqSchema ) {
            echo $faqSchema;
        }, 2 );
        
    ?>

    <div class="tm-section-faq tm-container bordered">
        <?php echo do_shortcode($content) ?>
    </div>

<?php $html = ob_get_contents();

    ob_end_clean();

    return $html;
}
add_shortcode('tm_faqs', 'tmFaqs');
?>