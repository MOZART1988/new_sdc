<?php
/**
 * @var WP_Post $post
*/
?>

<a href="<?=get_permalink($post)?>" class="event__col">
    <div class="event__col__img"><img src="<?=get_the_post_thumbnail_url($post, 'events')?>"></div>
    <h5><?=$post->post_title;?></h5>
    <p><?=get_post_meta($post->ID)['pst_short_text_original'][0]?></p>
</a>

