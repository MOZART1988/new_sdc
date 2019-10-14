<?php
/* Template Name: Главная страница */

global $tabArray;
$counter = 1;

$mainBanner = get_theme_mod('mainBanner', '/img/img-1.jpg');
$mainBannerHtml = '<img src="/img/img-1.jpg">';

if ($mainBanner !== '/img/img-1.jpg') {

    if (sdc_is_video($mainBanner)) {
        $mainBannerHtml = '<video id="banner-video" width="100%" autoplay playsinline muted="muted" loop>
                    <source src="'.$mainBanner.'" type="video/mp4">
                    Your browser does not support the video tag.
            </video>';
    } else {
        $mainBannerHtml = '<img src="'.$mainBanner.'">';
    }
}


get_header(); ?>
<div class="main"><!-- main content -->
    <section class="banner"><!-- main banner -->
        <?=$mainBannerHtml?>
        <span data-title="<?=pll__('Мы Работаем на <span>результат</span>,<br> чтоб результат работал на вас!')?>" class="banner__title"></span>
    </section><!-- main banner -->
    <section class="about"><!-- main about -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title"><?=get_theme_mod('about_title_' . pll_current_language(), '')?></h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=get_theme_mod('about_description_' . pll_current_language(), '')?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <img src="<?=get_theme_mod('about_image', '/img/img-2.png')?>">
                    <span><?=get_theme_mod('about_text_' . pll_current_language(), '')?></span>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <ul class="about__nav tabs">
                        <?php foreach ($tabArray as $key => $value) : ?>
                            <li class="<?=$counter === 1 ? 'active' : ''?>"><a href="#tab<?=$key?>"><?=$value?></a></li>
                            <?php $counter++; ?>
                        <?php endforeach ; ?>
                    </ul>
                    <select class="dropdown">
                        <?php foreach ($tabArray as $key => $value) : ?>
                            <option value="<?=$key?>"><?=$value?></option>
                        <?php endforeach ; ?>
                    </select>
                    <?php foreach ($tabArray as $key => $value) : ?>
                        <div class="tabs--block" id="tab<?=$key?>" <?=($key === 1 ? 'style="display: block"' : '')?>>
                            <div class="row">
                                <?php
                                $loop = new WP_Query([
                                    'post_type'=>'mainpage_tab_item',
                                    'posts_per_page' => -1,
                                    'lang' => pll_current_language(),
                                    'meta_query' => [
                                        [
                                            'key' => 'mainpage_tab_category',
                                            'value' => $key,
                                            'compare' => '='
                                        ]
                                    ],
                                    'orderby'=>'menu_order',
                                    'order' => 'ASC'
                                ]);
                                ?>
                                <?php while ($loop->have_posts()): $loop->the_post(); ?>
                                    <div class="col-md-4 col-sm-6 col-xs-6">
                                        <div class="about__img">
                                            <img src="<?=get_the_post_thumbnail_url($post, 'full')?>">
                                        </div>
                                        <div class="about__text">
                                            <h6><?=$post->post_title?></h6>
                                            <p><?=$post->post_excerpt?></p>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endforeach ; ?>
                </div>
            </div>
        </div>
    </section><!-- main about -->
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- main content -->

<?php get_footer(); ?>
