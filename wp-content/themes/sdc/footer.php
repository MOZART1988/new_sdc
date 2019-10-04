<?php
/**
 * The template for displaying the footer
 *
 * Displays all of the footer element.
 *
 * @package WordPress
 */

global $portfolioPage;
global $contactsPage;
global $eventsPage;
global $clientsPage;

/**
 * @var WP_Term $portfolioPage
 * @var WP_Post $contactsPage
 * @var WP_Term $clientsPage
 * @var WP_Term $eventsPage
 */

$presentationsLoop = new WP_Query( [
    'post_type'=>'direction_item',
    'posts_per_page' => -1,
    'lang' => pll_current_language(),
    'orderby' => 'menu_order',
    'order' => 'ASC'
] );

$directionsLoop = new WP_Query(  [
    'post_type'=>'direction_item',
    'posts_per_page' => -1,
    'lang' => pll_current_language(),
    'orderby' => 'menu_order',
    'order' => 'ASC'
] );

?>
<footer><!-- footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <h6><?=pll__('Компания')?></h6>
                <ul>
                    <li class="<?=sdc_is_front_page() ? 'active' : ''?>">
                        <a href="/"><?=pll__('О компании')?></a>
                    </li>
                    <?php if ($eventsPage !== false) : ?>
                        <li class="<?=(sdc_is_events_page() ? 'active' : '')?>">
                            <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($contactsPage !== false) : ?>
                        <li class="<?=(sdc_is_contacts_page() ? 'active' : '')?>">
                            <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($clientsPage !== false) : ?>
                        <li class="<?=(sdc_is_clients_page() ? 'active' : '')?>">
                            <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if (!empty($directionsLoop->have_posts())) : ?>
                <div class="col-md-3 col-sm-6">
                    <h6><?=pll__('Услуги')?></h6>
                    <ul>
                    <?php while($directionsLoop->have_posts()) : $directionsLoop->the_post();  ?>
                        <?php get_template_part( 'templates/categories/direction/direction_footer_item', 'index' );?>
                    <?php endwhile;?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
            <?php if (!empty($presentationsLoop->have_posts())) : ?>
            <div class="col-md-4 col-sm-12 col--files">
                <h6><?=pll__('Полезная информация')?></h6>
                <ul>
                    <?php while($presentationsLoop->have_posts()): $presentationsLoop->the_post(); ?>
                        <?php get_template_part('templates/main/presentation-link', 'menu')?>
                    <?php endwhile; ?>
                </ul>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata() ?>
            <div class="col-md-4 col-sm-12 col--files">
                <h6><?=pll__('Полезная информация')?></h6>
                <ul>
                    <li>
                        <a href="<?=get_theme_mod('smm_presentation', '#')?>" target="_blank">
                            <?=pll__('Скачать презентацию по СММ')?>
                            <span><?=get_remote_filesize(get_theme_mod('smm_presentation', '#'))?> кб</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=get_theme_mod('website_presentation', '#')?>" target="_blank">
                            <?=pll__('Скачать презентацию по разработке сайтов')?>
                            <span><?=get_remote_filesize(get_theme_mod('website_presentation', '#'))?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?=get_theme_mod('marketing_presentation', '#')?>" target="_blank">
                            <?=pll__('Скачать презентацию по маркетинговому консалтингу')?>
                            <span><?=get_remote_filesize(get_theme_mod('website_presentation', '#'))?></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12 col--logo">
                <?=sdc_footer_logo()?>
                <p><?php _e('© 2012–2018 Рекламное агентство', 'SDC'); ?> <br> <?php _e('Smart Digital Consulting', 'SDC'); ?></p>
            </div>
        </div>
    </div>
</footer><!-- footer -->

<?php wp_footer(); ?>

</body>
</html>
