<?php
/**
 * Other portfolio items template
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
    'cat' => $category[0]->term_id,
    'post__not_in' => [$mainPost->ID],
    'post_type' => 'portfolio_item'
];

$loop = new WP_Query( $args );

?>

<?php if ($loop->have_posts()): ?>
    <div class="recommended">
        <div class="container">
            <h3><?=pll__('Посмотрите другие проекты, которые мы сделали')?></h3>
        </div>
        <div class="recommended__slider" id="recommended__slider--1">
        <?php foreach ($loop->posts as $post):?>
            <?php
            /**
             * @var WP_Post $post
            */
            ?>
            <a href="<?=get_permalink($post)?>" class="recommended__slider__col">
                <img src="<?=get_the_post_thumbnail_url($post, 'portfolio')?>">
                <span><?=$post->post_title?></span>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>



