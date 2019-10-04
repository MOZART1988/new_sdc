<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 01.10.18
 * Time: 16:35
 */

get_header();
$postId = get_post()->ID;

if (!empty(get_post_meta($postId, 'client_item_logo'))) {
    $url = get_post_meta($postId, 'client_item_logo')[0];
    $logo = wp_get_attachment_image_src($url, 'client-thumb')[0];
}

?>
<div class="page portfolio--unit"><!-- page content -->
    <?php while(have_posts()) : the_post()?>
        <div class="banner second">
            <?php get_template_part('/templates/categories/clients/clients', 'breadcumps')?>
        </div>
        <div class="container portfolio--container">
            <div class="portfolio--unit__block">
                <div class="portfolio--unit__block__row" style="width: 100%">
                    <div class="col-lg-10 col-md-9 col-sm-9">
                        <?php the_title('<h1>', '</h1>'); ?>
                        <p><?php the_content(); ?></p>
                    </div>
                    <?php if (!empty($logo)) : ?>
                        <div class="col-lg-2 col-md-3 col-sm-3">
                            <img src="<?=$logo?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <h3 class="text-center"><?=pll__('Все работы для компании')?> <?=$post->post_title?></h3>
            <?php get_template_part('templates/categories/portfolio/portfolio_categories', 'index'); ?>
            <div class="portfolio-ajax-result-for-slider">
                <?php hm_get_template_part('templates/categories/portfolio/portfolio_slider', ['clientId' => $post->ID, 'categoryId' => 'all']); ?>
            </div>
        </div>
        <?=hm_get_template_part('templates/categories/clients/other-clients', ['mainPost' => $post, 'category' => get_the_category()]) ?>
        <?php get_template_part('templates/main/request', 'project'); ?>
        <?php get_template_part('templates/main/request', 'phone'); ?>
    <?php endwhile; ?>
</div><!-- page content -->
<?php get_footer(); ?>

