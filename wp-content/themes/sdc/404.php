<?php
/**
 * The 404 template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 */
get_header(); ?>
<div class="main"><!-- main content -->
    <section class="about"><!-- main about -->
        <div class="container">
            <div class="row">
                <h1><?=pll__('Страница не найдена')?></h1>
            </div>
        </div>
    </section><!-- main about -->
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- main content -->

<?php get_footer(); ?>
