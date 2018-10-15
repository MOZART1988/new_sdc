<?php
/**
 * Template for single portfolio item
 */
get_header();

$postId = get_post()->ID;

$bannerImage = null;

if (!empty(get_post_meta($postId, 'pt_custom_image_one'))) {
    $url = get_post_meta($postId, 'pt_custom_image_one')[0];
    $bannerImage = wp_get_attachment_image_src($url, 'portfolio-banner')[0];
}

$client = null;

if (!empty(get_post_meta($postId, 'pt_client_id_original'))) {
    $clientId = get_post_meta($postId, 'pt_client_id_original')[0];
    $client = get_post($clientId);
}

$goal = null;

if (!empty(get_post_meta($postId, 'pt_goal_original'))) {
    $goal = get_post_meta($postId, 'pt_goal_original')[0];
}

$desicion = null;

if (!empty(get_post_meta($postId, 'pt_desicion_original'))) {
    $desicion = get_post_meta($postId, 'pt_desicion_original')[0];
}

$screenShootOne = null;

if (!empty(get_post_meta(get_post()->ID, 'pt_screenshoot_one'))) {
    $url = get_post_meta($postId, 'pt_screenshoot_one')[0];
    $screenShootOne = wp_get_attachment_image_src($url, 'portfolio-screenshoot-one')[0];
}

$screenShootTwo = null;

if (!empty(get_post_meta(get_post()->ID, 'pt_screenshoot_two'))) {
    $url = get_post_meta($postId, 'pt_screenshoot_two')[0];
    $screenShootTwo = wp_get_attachment_image_src($url, 'portfolio-screenshoot-one')[0];
}

$quote = null;

if (!empty(get_post_meta($postId, 'pt_quote'))) {
    $quote = get_post_meta($postId, 'pt_quote')[0];
}

$videoBlock = null;

if (!empty(get_post_meta($postId, 'pt_video'))) {
    $videoBlock = get_post_meta($postId, 'pt_video')[0];
}

?>

<div class="page portfolio--unit"><!-- page content -->
    <div class="banner">
        <?php get_template_part('templates/categories/portfolio/portfolio', 'breadcumps')?>
        <?php if (!empty($bannerImage)) : ?>
            <img src="<?=$bannerImage?>">
        <?php endif; ?>
    </div>
    <div class="container portfolio--container">
        <?php the_title('<h1>', '</h1>'); ?>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-3">
                <img src="<?=get_the_post_thumbnail_url($post, 'client-thumb')?>">
            </div>
            <div class="col-lg-9 col-md-10 col-sm-9">
                <table>
                    <?php if (!empty($client)) : ?>
                        <tr>
                            <td><h6><?=pll__('Клиент:')?></h6></td>
                            <td><h6><?=$client->post_title?></h6></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (!empty($goal)) : ?>
                        <tr>
                            <td><h6><?=pll__('Задача:')?></h6></td>
                            <td><?=$goal?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if (!empty($desicion)) : ?>
                        <tr>
                            <td><h6><?=pll__('Решение:')?></h6></td>
                            <td><?=$desicion?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <?php if (!empty($screenShootOne)) : ?>
            <div class="portfolio--unit__browser--height">
                <div class="portfolio--unit__browser--height__top">
                    <img src="/img/img-47.jpg">
                </div>
                <img src="<?=$screenShootOne?>">
                <!--<span style="top: 20%">Главная страница сайта. Слайдер меняется в зависимости от акции</span>
                <span style="top: 37%">Каждая иконка отрисовывалась вручную для каждого раздела.</span>-->
                <div class="portfolio--unit__browser--height__bottom">
                    <img src="/img/img-48.jpg">
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($quote)) : ?>
            <div class="quotes--block">
                <h5><?=$quote?></h5>
            </div>
        <?php endif; ?>
        <?php if (!empty($screenShootTwo)) : ?>
            <div class="portfolio--unit__browser--width">
                <div class="portfolio--unit__browser--width__top">
                    <img src="/img/img-51.jpg">
                </div>
                <img src="<?=$screenShootTwo?>">
                <div class="portfolio--unit__browser--width__bottom">
                    <img src="/img/img-52.jpg">
                </div>
            </div>
        <?php endif; ?>

        <div class="portfolio--unit__text">
            <?php the_content()?>
        </div>
        <?php if (!empty(get_post_gallery_ids())) : ?>
            <?php $ids = get_post_gallery_ids(); ?>
            <div class="portfolio--unit__for">
                <?php foreach ($ids as $id) : ?>
                    <a href="<?=wp_get_attachment_url($id)?>" class="fancy">
                        <img src="<?=wp_get_attachment_image_src($id, 'slide')[0]?>"
                             alt="<?=wp_get_attachment_image_src($id, 'slide')[0]?>">
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="portfolio--unit__nav">
                <?php for ($i = 1; $i <= count($ids); $i++) : ?>
                    <div><?=$i?>/<?=count($ids)?></div>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($videoBlock)) : ?>
            <div class="portfolio--unit__video">
                <?=$videoBlock?>
            </div>
        <?php endif ?>

        <!--<div class="portfolio--unit__table">
            <table>
                <tr>
                    <th>Пункт номер один</th>
                    <th>Пункт номер два</th>
                    <th>Пункт номер три</th>
                    <th>Пункт номер три</th>
                    <th>Пункт номер пять</th>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
                <tr>
                    <td>Пункт номер один</td>
                    <td>Пункт номер два</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер три</td>
                    <td>Пункт номер пять</td>
                </tr>
            </table>
        </div>-->
        <?php if (!empty($client) && !empty($clientId)) : ?>
            <h3 class="text-center"><?=pll__('Все работы для компании')?> <?=$client->post_title?></h3>
            <?php get_template_part('templates/categories/portfolio/portfolio_categories', 'index'); ?>
            <div class="portfolio-ajax-result-for-slider">
                <?php hm_get_template_part('templates/categories/portfolio/portfolio_slider', ['clientId' => $clientId, 'categoryId' => 'all']); ?>
            </div>
        <?php endif; ?>
        <?php get_template_part('templates/main/request', 'project'); ?>
    </div>
    <?php hm_get_template_part('templates/categories/portfolio/other-items', ['mainPost' => get_post(), 'category' => get_the_category()]); ?>
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- page content -->

<?php get_footer() ?>
