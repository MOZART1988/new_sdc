<?php
/**
 * @var WP_Post $post
 */
?>
<li>
    <a href="<?=get_the_post_thumbnail_url($post, 'full')?>" target="_blank">
        <?=$post->post_title?>
        <span><?=get_remote_filesize(get_the_post_thumbnail_url($post, 'full'))?> кб</span>
    </a>
</li>
