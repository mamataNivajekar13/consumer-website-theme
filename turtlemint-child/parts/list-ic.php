<!-- Insurers - Start -->
<?php 
    $terms = $args['terms'];
    $elementLimit = $args['elementLimit'];
    $vertical_name = $args['vertical_name'];
    $columns = $args['columns'];

    $totalElements = count($terms);
    if($totalElements > $elementLimit){
    $terms_insurer_features_set1 = array_slice($terms, 0, $elementLimit);
    $terms_insurer_features_set2 = array_slice($terms, $elementLimit);
?>
<div class="viewMoreContainer tm-insurance-companies-list <?php if($columns != ''): echo "column-".$columns."-list"; endif; ?>">
    <?php foreach($terms_insurer_features_set1 as $child_term_id): ?>
        <?php 
        $insurer_logo = $child_term_id['logo'];
        $ic_display_name = $child_term_id['insurer'];
        $ic_url = $child_term_id['url'];
        ?>
    <div class="tm-insurance-company">
        <div class="tm-insurance-company__wrapper">
        <a class="tm-insurance-company__logo" href="<?php echo home_url().$ic_url; ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
            <?php if($insurer_logo):?>
            <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo site_url()."/wp-content/uploads/".$insurer_logo; ?>">
            <?php else:?>
            <div class="tm-insurance-company__placeholder"></div>
            <?php endif;?>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php foreach($terms_insurer_features_set2 as $child_term_id): ?>
        <?php 
        $insurer_logo = $child_term_id['logo'];
        $ic_display_name = $child_term_id['insurer'];
        $ic_url = $child_term_id['url'];
        ?>
    <div class="view-more-hidden tm-insurance-company">
        <div class="tm-insurance-company__wrapper">
        <a class="tm-insurance-company__logo" href="<?php echo home_url().$ic_url; ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
            <?php if($insurer_logo):?>
            <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo site_url()."/wp-content/uploads/".$insurer_logo; ?>">
            <?php else:?>
            <div class="tm-insurance-company__placeholder"></div>
            <?php endif;?>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="cta-links" style="margin-top:24px">
    <button class="wp-block-button tm-button viewMoreLink">
    <a class="wp-block-button__link wp-element-button"><span>View More</span></a>
    </button>
</div>

<?php } else{ ?>
    <div class="tm-insurance-companies-list">
    <?php foreach($terms as $child_term_id): ?>
        <?php 
        $insurer_logo = $child_term_id['logo'];
        $ic_display_name = $child_term_id['insurer'];
        $ic_url = $child_term_id['url'];
        ?>
        <div class="tm-insurance-company">
        <div class="tm-insurance-company__wrapper">
        <a class="tm-insurance-company__logo" href="<?php echo home_url().$ic_url; ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
            <?php if($insurer_logo):?>
            <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo site_url()."/wp-content/uploads/".$insurer_logo; ?>">
            <?php else:?>
            <div class="tm-insurance-company__placeholder"></div>
            <?php endif;?>
        </a>
        </div>
        </div>
    <?php endforeach; ?>
</div>
<?php } ?>
<!-- Insurers - End -->