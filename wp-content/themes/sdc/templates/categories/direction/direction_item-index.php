<?php
/**
 * @var WP_Post $post
 */
$url = !empty(get_post_meta($post->ID, 'direction_landing_url')[0]) ? get_post_meta($post->ID, 'direction_landing_url')[0] : '#';
?>
<div class="coll">
    <a href="<?=$url?>" class="direction__slider__col">
        <img src="<?=get_the_post_thumbnail_url($post, 'direction')?>">
        <h5><?=$post->post_title?></h5>
    </a>
</div>
