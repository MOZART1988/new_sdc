<?php
/**
 * @var WP_Post $post
 */
?>
<div class="coll">
    <a href="#" class="direction__slider__col">
        <img src="<?=get_the_post_thumbnail_url($post, 'direction')?>">
        <h5><?=$post->post_title?></h5>
    </a>
</div>
