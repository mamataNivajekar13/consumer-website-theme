<?php

?>
<script type="text/javascript">
    const base_url = '<?php echo site_url() ?>';
</script>

<?php

/* Customize Variables */
$ga_tracking_id = get_option('tm_ga_tracking_id', '');
$ga4_tracking_id = get_option('tm_ga4_tracking_id', '');
$gtm_id = get_option('tm_gtm_id', '');

?>

<?php if ($gtm_id) : ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.defer = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', '<?php echo $gtm_id; ?>');
    </script>
<?php endif; ?>

<?php if ($ga_tracking_id || $ga4_tracking_id) : ?>
    <!-- Google tag (gtag.js) -->

    <?php if ($ga_tracking_id) : ?>
        <script defer src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_tracking_id; ?>"></script>
    <?php endif; ?>
    <?php if ($ga4_tracking_id) : ?>
        <script defer src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga4_tracking_id; ?>"></script>
    <?php endif; ?>

    <!-- Google tag (gtag.js) Omkar 20230301-->
    <!-- <script defer src="https://www.googletagmanager.com/gtag/js?id=DC-11590263"></script> -->

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        <?php if ($ga_tracking_id) : ?>
            gtag('config', '<?php echo $ga_tracking_id; ?>', {
            send_page_view: false
            });
        <?php endif; ?>

        <?php if ($ga4_tracking_id) : ?>
            gtag('config', '<?php echo $ga4_tracking_id; ?>');
        <?php endif; ?>

        /* gtag('config', 'DC-11590263'); */ //Google tag (gtag.js) Omkar 20230301
    </script>

<?php endif; ?>

<!--
Event snippet for Turtlemint Pixel on https://www.turtlemint.com/: Please do not remove.
Place this snippet on pages with events you're tracking. 
Creation date: 03/01/2023
Omkar 20230301
-->
<!-- <script>
  gtag('event', 'conversion', {
    'allow_custom_scripts': true,
    'send_to': 'DC-11590263/count0/turtl0+standard'
  });
</script>
<noscript>
<img src="https://ad.doubleclick.net/ddm/activity/src=11590263;type=count0;cat=turtl0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;gdpr=${GDPR};gdpr_consent=${GDPR_CONSENT_755};ord=1?" width="1" height="1" alt=""/>
</noscript> -->
<!-- End of event snippet: Please do not remove -->

<?php
    global $template;
    $templateName = basename($template);
    if(is_tax('health-insurer') || is_tax('bike-insurer') || is_tax('car-insurer') || $templateName == 'ic-renewal.php' || $templateName == 'ic-customer-care.php' || $templateName == 'ic-premium-calculator.php' || $templateName == 'ic-claim-settlement.php' || $templateName == 'ic-benefits.php' || $templateName == 'ic-critical-illness.php' || $templateName == 'ic-plans.php'){
        $term = get_queried_object();

        if(!$term){
            $health_term_slug = get_query_var( 'health-ic' );
            if($health_term_slug){
              $term = get_term_by( 'slug', $health_term_slug, 'health-insurer' );
            }
        }

        $insurer_faqs = get_field('insurer_faqs', $term);

        if($insurer_faqs){
            $icFaqSchema = '<!-- FAQ Schema - Start -->
            <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [';

            $entities = [];

            foreach ($insurer_faqs as $insurer_faq){
            $question = $insurer_faq['insurer_faq_title'];
            $answer = $insurer_faq['insurer_faq_description'];

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

            $icFaqSchema .= implode(', ', $entities);

            $icFaqSchema .=']
            }
            </script>
            <!-- FAQ Schema - End -->';
            echo $icFaqSchema;
        }
    }
  ?>