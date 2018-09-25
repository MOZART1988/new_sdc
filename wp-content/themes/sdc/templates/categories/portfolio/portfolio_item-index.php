<?php
/**
 * @var WP_Post $post
 */

?>
<div class="col-sm-4">
    <a href="<?=get_post_permalink($post)?>" class="portfolio__col">
        <img src="<?=get_the_post_thumbnail_url($post, 'portfolio')?>">
        <span class="<?=get_post_meta($post->ID)['pt_title_color_original'][0]?>"><?= $post->post_title; ?></span>
    </a>
</div>
