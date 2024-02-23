<?php
    // attributes
    $plan_content = preg_replace('/<!--(.*?)-->/s', '', get_the_content());
    $plan_title = get_the_title();
    $plan_ncb = get_field('ncb');
    $plan_ped_waiting_period = get_field('plan_ped_waiting_period');
    $plan_coverage_minimum = get_field('plan_coverage_minimum');
    $plan_coverage_maximum = get_field('plan_coverage_maximum');
    $plan_eligible_age_minimum = get_field('plan_eligible_age_minimum');
    $plan_eligible_age_maximum = get_field('plan_eligible_age_maximum');
    $plan_top = get_field('plan_top');
    $plan_starting_premium = get_field('plan_starting_premium');
    $vertical_name = $args['vertical'];
    $insurer_display_name = $args['insurer'];
    $plan_subtype = $args['plan_subtype'];
    $vertical_name_category = tm_event_category();
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
        <p class="tm-link toggleExpand mb-0 d-inline-flex" data-eventaction="<?php echo $eventAction; ?>" data-eventcategory="<?php echo $vertical_name_category; ?>" data-eventlabel="<?php echo $insurer_display_name; ?>" data-ctadetails="<?php echo trim($plan_title); ?>" onclick="toggleContent(this);tmClickEvent('<?php echo $eventAction; ?>', '<?php echo $vertical_name_category; ?>', '<?php echo $insurer_display_name; ?>', '<?php echo trim($plan_title); ?>')"><a class="icon-link" title="<?php echo ucwords($plan_title." description"); ?>"><span>Read More</span><i class="tm-sprite-1 bg-chevron-down-green"></i></a></p>
        <?php endif; ?>
        <div class="plan-card__highlights">
            <div class="highlight">
                <i class="highlight-icon tm-sprite-1 bg-calendar-with-date"></i>
                <p class="has-turtlemint-child-tm-small-font-size highlight-title">Eligible Age</p>
                <p class="has-turtlemint-child-tm-small-font-size highlight-description">
                <?php
                    if($plan_eligible_age_minimum && $plan_eligible_age_maximum){
                        echo convertDays($plan_eligible_age_minimum)." - ".convertDays($plan_eligible_age_maximum);
                    }else if($plan_eligible_age_minimum){
                        echo convertDays($plan_eligible_age_minimum)." onwards";
                    }else if($plan_eligible_age_maximum){
                        echo "Upto ".convertDays($plan_eligible_age_maximum);
                    }
                    else{
                        echo "NA";
                    }
                ?>
                </p>
            </div>
            <div class="highlight">
                <i class="highlight-icon tm-sprite-1 bg-clock-border"></i>
                <p class="has-turtlemint-child-tm-small-font-size highlight-title">PED Waiting Period</p>
                <p class="has-turtlemint-child-tm-small-font-size highlight-description"><?php if($plan_ped_waiting_period): echo convertDays($plan_ped_waiting_period); else: echo "NA"; endif; ?></p>
            </div>
            <div class="highlight">
                <i class="highlight-icon tm-sprite-1 bg-coverage"></i>
                <p class="has-turtlemint-child-tm-small-font-size highlight-title">Coverage</p>
                <p class="has-turtlemint-child-tm-small-font-size highlight-description">
                    <?php
                        if($plan_coverage_minimum && $plan_coverage_maximum){
                            echo convertNumber($plan_coverage_minimum)." - ".convertNumber($plan_coverage_maximum);
                        }
                        else{
                            echo "NA";
                        }
                    ?>
                </p>
            </div>
            <div class="highlight">
                <i class="highlight-icon tm-sprite-1 bg-hands"></i>
                <p class="has-turtlemint-child-tm-small-font-size highlight-title">NCB</p>
                <p class="has-turtlemint-child-tm-small-font-size highlight-description"><?php if($plan_ncb): echo $plan_ncb; else: echo "NA"; endif; ?></p>
            </div>
        </div>
    </div>
</div>