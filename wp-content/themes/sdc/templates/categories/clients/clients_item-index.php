<?php
/**
 * @var WP_Post $post
 */
?>

<a href="<?=get_post_permalink($post)?>">
    <img src="<?=get_the_post_thumbnail_url($post, 'client-list')?>">
</a>

