<?php

$args = [
    'post_type' => 'case_smm_landing',
    'posts_per_page' => 10,
];

$loop = new WP_Query( $args );


?>
<section class="section section9 red">
    <div class="container">
        <h2><?=pll__('Кейсы')?></h2>
    </div>
    <?php if ($loop->have_posts()) : $loop->the_post(); ?>
    <div class="cases">
        <?php foreach ($loop->posts as $post) : ?>
            <?php
                /**
                 * @var WP_Post $post
                */

                $url = get_post_meta($post->ID, 'case_smm_landing_url', true);
            ?>
            <div>
                <div class="container">
                    <div class="col">
                        <div class="cases__name">
                            <div class="cases__name__img"><img src="<?=get_the_post_thumbnail_url($post, 'smm_cases_main')?>" alt=""></div>
                            <span class="cases__name__title"><?=$post->post_title?></span>
                        </div>
                        <div class="content-case">
                            <?=$post->post_content?>
                        </div>
                        <a href="<?=!empty($url) ? $url : ''?>" class="btn"><?=pll__('Просмотреть результат')?></a>
                    </div>

                    <?php if (!empty(get_post_gallery_ids($post->ID))) : ?>
                        <?php
                            $ids = get_post_gallery_ids($post->ID);
                        ?>
                        <div class="col cases__slider">
                            <?php foreach ($ids as $id) : ?>
                                <div><img src="<?=wp_get_attachment_image_src($id, 'smm_cases_slide')[0]?>" alt=""></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="bg" data-offset="55"><img src="/img/bg-1.png" alt=""></div>
    <div class="bg" data-offset="10"><img src="/img/bg-2.png" alt=""></div>
    <div class="bg" data-offset="25"><img src="/img/bg-3.png" alt=""></div>
    <?php endif; ?>
</section>
