<?php
/**
 * @var WP_Post $post
*/
?>

<a href="<?=get_permalink($post)?>" class="event__col">
    <div class="event__col__img"><img src="<?=get_the_post_thumbnail_url($post, 'events')?>"></div>
    <h5><?=$post->post_title;?></h5>
    <p>В свежем ролике для Юлы мы ненавязчиво рассказываем о новом разделе сервиса — «Недвижимость». Вдохновлялись, конечно, каннскими кейсами OK Go. </p>
</a>

