<?php
/**
 * Other clients template
 * @var array $template_args
 */

$category = $template_args['category'];
$mainPost = $template_args['mainPost'];
/**
 * @var WP_Post $mainPost
 * @var WP_Term $categpry
 */


$args = [
    'posts_per_page' => 16,
    'orderby' => 'rand',
    'post__not_in' => [$mainPost->ID],
    'post_type' => 'client_item',
    'lang' => pll_current_language(),
];

$loop = new WP_Query( $args );
?>
<?php if ($loop->have_posts()): ?>
    <div class="recommended second">
        <div class="container">
            <h3><?=pll__('Другие наши клиенты')?></h3>
            <div class="recommended__slider" id="recommended__slider--2">
                <?php foreach ($loop->posts as $post) : ?>
                    <a href="<?=get_permalink($post)?>" class="recommended__slider__col">
                        <img src="<?=get_the_post_thumbnail_url($post, 'client-others')?>"">
                        <span class="<?=@get_post_meta($post->ID)['cl_title_color_original'][0]?>"><?=$post->post_title?></span>
                    </a>
                <?php endforeach ; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
