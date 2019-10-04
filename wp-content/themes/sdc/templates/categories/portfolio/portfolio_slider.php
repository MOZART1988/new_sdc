<?php
/**
 * Template for slider block on  single client page etc
 * @var array $template_args
*/




$clientId = $template_args['clientId'];
$categoryId = $template_args['categoryId'];

$args = [
    'post_type'=>'portfolio_item',
    'posts_per_page' => 6,
    'lang' => pll_current_language(),
    'meta_key' => 'pt_client_id_original',
    'meta_value' => $clientId,
];

if ($categoryId !== 'all') {
    $args = [
        'post_type'=>'portfolio_item',
        'posts_per_page' => 6,
        'lang' => pll_current_language(),
        'meta_key' => 'pt_client_id_original',
        'meta_value' => $clientId,
        'cat' => $categoryId
    ];
}


$loop = new WP_Query( $args );


?>

<?php if ($loop->have_posts()) : $loop->the_post(); ?>
    <div class="portfolio">
        <div class="slider portfolio__for" id="portfolio__for--1">
            <?php foreach ($loop->posts as $post) : ?>
                <?php
                    /**
                     * @var $post WP_Post
                    */
                ?>
                <div>
                    <div class="portfolio__for__col left">
                        <a href="<?=get_the_post_thumbnail_url($post, 'portfolio-slide')?>" class="fancy">
                            <img src="<?=get_the_post_thumbnail_url($post, 'full')?>">
                        </a>
                    </div>
                    <div class="portfolio__for__col right">
                        <span class="portfolio__for__col__title"><?=$post->post_title?></span>
                        <?php if (!empty(get_post_meta($post->ID, 'pt_goal_original'))) : ?>
                            <span class="portfolio__for__col__task"><strong><?=pll__('Задача:')?></strong>
                                <?=get_post_meta($post->ID, 'pt_goal_original')[0]?>.</span>
                        <?php endif; ?>
                        <a href="<?=get_permalink($post)?>" class="btn"><?=pll__('Просмотреть результат')?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="portfolio__slider--nav" id="portfolio__nav--1">
            <?php foreach ($loop->posts as $post) : ?>

                <?php
                    $slideText = get_post_meta($post->ID, 'pt_slide_text')[0];

                    if (empty($slideText)) {
                        $slideText = get_the_category( $post->ID )[0]->name;
                    }

                ?>

                <div>
                    <span><?=$slideText ?></span>
                    <img src="<?=get_the_post_thumbnail_url($post, 'portfolio-slide-small')?>">
                </div>
            <?php endforeach ; ?>
        </div>
    </div>
<?php endif; ?>
