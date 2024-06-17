<?php

/* Customize Variables */
$ga_tracking_id = get_option('tm_ga_tracking_id', '');
$ga4_tracking_id = get_option('tm_ga4_tracking_id', '');
$gtm_id = get_option('tm_gtm_id', '');

if ($gtm_id) : ?>
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
        
    </script>

<?php endif; ?>