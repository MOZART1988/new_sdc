<?php
/**
 * Other events template
 * @var array $template_args
 */

$category = $template_args['category'];
$mainPost = $template_args['mainPost'];
/**
 * @var WP_Post $mainPost
 * @var WP_Term $categpry
 */


$args = [
    'limit' => 5,
    'orderby' => 'rand',
    //'cat' => $category[0]->term_id,
    'post__not_in' => [$mainPost->ID],
    'post_type' => 'post'
];

$loop = new WP_Query( $args );

?>

<?php if ($loop->have_posts()): ?>
    <div class="event__slider">
    <?php foreach ($loop->posts as $post):?>
        <a href="<?=get_permalink($post)?>">
            <div class="event__slider__img">
                <img src="<?=get_the_post_thumbnail_url($post, 'events')?>">
            </div>
            <h5><?=$post->post_title?></h5>
            <p><?=get_post_meta($post->ID)['pst_short_text_original'][0]?></p>
        </a>
    <?php endforeach; ?>
    </div>
<?php endif; ?>



