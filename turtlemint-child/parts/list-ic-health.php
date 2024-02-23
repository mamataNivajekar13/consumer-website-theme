<!-- Health Insurers - Start -->
<?php 
    $terms = $args['terms'];
    $elementLimit = $args['elementLimit'];
    $vertical_name = $args['vertical_name'];
    
    $totalElements = count($terms);
    if($totalElements > $elementLimit){
    $insurer_features_set1 = array_slice($terms, 0, $elementLimit);
    $insurer_features_set2 = array_slice($terms, $elementLimit);
?>
<div class="viewMoreContainer tm-insurance-companies-list">
    <?php foreach($insurer_features_set1 as $child_term_id): ?>
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
        <a class="tm-insurance-company__logo" href="<?php echo get_term_link($child_term_id); ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
            <?php if($insurer_logo):?>
            <img loading="lazy" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>" alt="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance logo"); ?>" height="85" width="auto" src="<?php echo $insurer_logo; ?>">
            <?php else:?>
            <div class="tm-insurance-company__placeholder"></div>
            <?php endif;?>
        </a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php foreach($insurer_features_set2 as $child_term_id): ?>
        <?php 
        $insurer_logo = get_field('insurer_logo', get_term( $child_term_id ));
        if(get_field('insurer_name', get_term( $child_term_id ))){
            $ic_display_name = ucwords(get_field('insurer_name', get_term( $child_term_id )));
        }else{
            $ic_display_name = ucwords(get_term( $child_term_id )->name);
        }
        ?>
    <div class="view-more-hidden tm-insurance-company">
        <div class="tm-insurance-company__wrapper">
        <a class="tm-insurance-company__logo" href="<?php echo get_term_link($child_term_id); ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
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
<div class="cta-links" style="margin-top:32px">
    <button class="wp-block-button tm-button viewMoreLink">
    <a class="wp-block-button__link wp-element-button"><span>View More</span></a>
    </button>
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
        <a class="tm-insurance-company__logo" href="<?php echo get_term_link($child_term_id); ?>" title="<?php echo ucwords($ic_display_name." ".$vertical_name." insurance"); ?>">
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
<!-- Health Insurers - End -->