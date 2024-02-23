<?php
    // attributes
    $plan_content = preg_replace('/<!--(.*?)-->/s', '', get_the_content());
    $plan_title = get_the_title();
    $plan_top = get_field('plan_top');
    $plan_starting_premium = get_field('plan_starting_premium');
    $vertical_name = $args['vertical'];
    $insurer_display_name = $args['insurer'];
    $plan_subtype = $args['plan_subtype'];

    $plan_link = "https://app.turtlemint.com/two-wheeler-insurance/two-wheeler-profile/tw-registration-info?_gl=1*1aar6k3*_ga*MTc1ODQyOTY3OS4xNjk5MTg0OTkw*_ga_RKQFLJSGZQ*MTY5OTI0MDY1NS4xLjEuMTY5OTI0MDY1OC41Ny4wLjA.";

    if($vertical_name == 'Car'){
        $plan_link = "https://app.turtlemint.com/car-insurance/car-profile/car-registration-info?_gl=1*7bi1bc*_ga*MjEzOTc5NzU4LjE3MDI1NTM5ODI.*_ga_RKQFLJSGZQ*MTcwMjU1Mzk4Mi4xLjEuMTcwMjU1NDM2OS42MC4wLjA";
    }
?>
<div class="plan-card" <?php if($plan_top == 1): echo 'style="padding-top: 14px;"'; endif; ?>>
    <?php if($plan_top == 1):?>
        <p class="top-plan-tag has-turtlemint-child-tm-small-font-size">Top Plan</p>
    <?php endif; ?>
    <div class="plan-card__wrapper has-turtlemint-child-white-background-color">
        <div class="card-header">
            <h3 class="plan-card__title has-turtlemint-child-tm-large-font-size"><?php echo ucwords($plan_title); ?><i class="tm-sprite bg-chevron-right"></i></h3>
            <?php if($plan_starting_premium): ?>
                <p class="premium-tag has-turtlemint-child-tm-small-font-size"><?php echo "Starting Premium- ₹ ".number_format($plan_starting_premium)."/yr"; ?></p>
            <?php endif; ?>
        </div>
        <?php if($plan_content): ?>
        <div class="tm-container__content has-toggle-expand-cta" data-max-height="55" data-max-height-mob="55">
            <p><?php echo $plan_content; ?></p>
        </div>
        <?php
            if($plan_subtype == 'top-up'){
                $eventAction = 'Top up plan read more';
            }else{
                $eventAction = 'Plan read more';
            }
        ?>
        <p class="tm-link toggleExpand mb-0 d-inline-flex" data-eventaction="<?php echo $eventAction; ?>" data-eventcategory="<?php echo $vertical_name; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" data-ctadetails="<?php echo trim($plan_title); ?>" onclick="toggleContent(this);tmClickEvent('<?php echo $eventAction; ?>', '<?php echo $vertical_name; ?>', '<?php echo $insurer_display_name; ?>', '<?php echo trim($plan_title); ?>')"><a class="icon-link" title="<?php echo ucwords("Read more about ".$plan_title); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
        <?php endif; ?>
        
        <button class="wp-block-button bordered green tm-button"><a href="<?php echo $plan_link; ?>" target="_blank" title="<?php echo "Buy ".$plan_title;?>" class="get-quote-cta wp-block-button__link wp-element-button">Buy Now</a></button>

    </div>
</div>