<?php
?>
<form role="search" method="get" action="<?php echo site_url() ?>" class="wp-block-search__button-inside wp-block-search__icon-button wp-block-search"><label for="wp-block-search__input-30" class="wp-block-search__label screen-reader-text">Search</label>
    <div class="wp-block-search__inside-wrapper " style="width: 100%;border-width: 0px;border-style: none">
        <input type="search" id="wp-block-search__input-30" class="wp-block-search__input" name="s" value="" placeholder="What are you looking for" style="border-radius: 8px">

        <?php
            if(is_category()){
                $category = get_queried_object();
                if(isset($category->slug)){
                    echo '<input type="hidden" name="category_name" value="'.$category->slug.'">';
                }
            }
            if(is_tag()){
                $tag = get_queried_object();
                if(isset($tag->slug)){
                    echo '<input type="hidden" name="tag" value="'.$tag->slug.'">';
                }
            }
        ?>

        <button type="submit" class="wp-block-search__button has-icon wp-element-button" style="border-radius: 8px" aria-label="Search">
            <svg class="search-icon" viewBox="0 0 24 24" width="24" height="24">
                <path d="M13.5 6C10.5 6 8 8.5 8 11.5c0 1.1.3 2.1.9 3l-3.4 3 1 1.1 3.4-2.9c1 .9 2.2 1.4 3.6 1.4 3 0 5.5-2.5 5.5-5.5C19 8.5 16.5 6 13.5 6zm0 9.5c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"></path>
            </svg>
        </button>
    </div>
</form>