<?php
/**
 * @var WP_Post $post
 */
?>
<li>
    <a href="<?=wp_get_attachment_url(get_post_thumbnail_id())?>" target="_blank">
        <?=$post->post_title?>
        <span><?=get_remote_filesize(wp_get_attachment_url(get_post_thumbnail_id()))?> кб</span>
    </a>
</li>
