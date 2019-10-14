<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 01.10.18
 * Time: 16:35
 */
get_header();
global $eventsPage;
?>
<div class="page portfolio--unit"><!-- page content -->
    <?php while(have_posts()) : the_post()?>
        <div class="banner second">
            <?php get_template_part('/templates/categories/events/events', 'breadcumps')?>
        </div>
        <div class="container portfolio--container">
            <section class="event"><!-- main event -->
                <h1><?=get_the_category()[0]->name; ?></h1>
                <div class="row event--row">
                    <div class="col-lg-3 col-md-4 left">
                        <img src="<?=get_the_post_thumbnail_url($post, 'event-single')?>">
                    </div>
                    <div class="col-lg-9 col-md-8 right">
                        <?php the_title( '<h3 class="event__name">', '</h3>' ); ?>
                        <p><?php the_content() ?></p>
                        <div class="event__block">
                            <?php if (!empty(wp_get_post_tags($post->ID))) : ?>
                                <span class="event__block__tags"><?=pll__('Метки:')?>
                                <?php foreach (wp_get_post_tags($post->ID) as $item) : ?>
                                    <a target="_blank"
                                       href="<?=get_category_link($eventsPage)?>?tag=<?=$item->name?>">
                                        <?=$item->name?>
                                    </a>
                                <?php endforeach ; ?>
                                </span>
                            <?php endif; ?>

                            <div class="event__block__right">
                                <span class="date"><?php echo get_the_date(); ?></span>
                                <div class="pluso"
                                     data-options="small,round,line,horizontal,nocounter,theme=04"
                                     data-services="vkontakte,facebook,odnoklassniki"
                                     data-url="<?=get_permalink()?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?=hm_get_template_part('templates/categories/events/other-events', ['mainPost' => $post, 'category' => get_the_category()]) ?>
            </section><!-- main event -->
        </div>
    <?php endwhile; ?>
</div><!-- page content -->
<?php get_footer(); ?>

