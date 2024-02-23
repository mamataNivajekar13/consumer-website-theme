<?php
    $post_id = get_the_ID();
    $post_title = get_the_title();
    $post_image = get_the_post_thumbnail_url($post_id, 'medium');
    $post_content = limitPostContent(strip_tags(get_the_content()), 130);
    $author_first_name = get_the_author_meta('first_name');
    $author_last_name = get_the_author_meta('last_name');
    if($author_first_name && $author_last_name){
        $author_name = $author_first_name." ".$author_last_name;
    }else{
        $author_name = $author_last_name;
    }
    $post_published_date = get_the_time('M d, Y');
    $post_url = get_the_permalink();

    $vertical_name = $args['vertical_name'];
    
    $insurer_display_name = $args['insurer_display_name'];

    $vertical_name_category = tm_event_category();
?>

<div class="tm-post-card">
    <a href="<?php echo $post_url;?>" class="tm-post-card__wrapper" title="<?php echo $post_title;?>" onclick="tmClickEvent('Article', '<?php echo $vertical_name_category;?>', '<?php if($insurer_display_name){echo $insurer_display_name;} ?>', '<?php echo $post_title;?>')">
        <div class="tm-post-card__image">
            <?php if($post_image):?>
                <img onload="imageLoaded(this)" loading="lazy" data-imgsrc="<?php echo $post_image; ?>" alt="<?php echo $post_title;?>" title="<?php echo $post_title;?>" height="118" width="auto">
            <?php else:?>
                <div class="tm-post-card__placeholder"></div>
            <?php endif; ?>
        </div>
        <p class="tm-post-card__title"><?php echo limitPostContent($post_title, 60);?></p>
        <p class="tm-post-card__description has-turtlemint-child-small-font-size has-turtlemint-child-tm-gray-color"><?php echo $post_content;?></p>
        <div class="tm-post-card__footer has-turtlemint-child-small-font-size has-turtlemint-child-tm-gray-color">
            <p class="author mb-0 text-truncate"><?php echo $author_name;?></p>
            <span>|</span>
            <p class="date mb-0 text-truncate"><?php echo $post_published_date;?></p>
        </div>
    </a>
</div>