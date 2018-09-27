<?php
/**
 * The template for displaying category based on its slug
 *
 * @var WP_Term $category
 * @package WordPress
 */


if (!empty(sdc_get_portfolio_category_from_request())) {

    $category = sdc_get_portfolio_category();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = [
        'post_type'=>'portfolio_item',
        'posts_per_page' => 9,
        'paged' => $paged,
        'lang' => pll_current_language()
    ];

    $loop = new WP_Query( $args );

    get_header();
    hm_get_template_part('templates/categories/portfolio/portfolio-main', ['loop' => $loop, 'category' => $category]);
}

if (!empty(sdc_get_direction_category_from_request())) {

    $category = sdc_get_direction_category();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = [
        'post_type'=>'direction_item',
        'posts_per_page' => 50,
        'paged' => $paged,
        'lang' => pll_current_language()
    ];

    $loop = new WP_Query( $args );

    get_header();
    hm_get_template_part('templates/categories/direction/direction-main', ['loop' => $loop, 'category' => $category]);
}


?>

<?php get_footer(); ?>

