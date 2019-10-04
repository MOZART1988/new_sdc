<?php
/**
 * @var WP_Post $post
 */
$url = !empty(get_post_meta($post->ID, 'direction_landing_url')[0])
    ? get_post_meta($post->ID, 'direction_landing_url')[0] : '#';
?>

<li>
    <a href="<?=$url?>">
        <?=$post->post_title?>
    </a>
</li>