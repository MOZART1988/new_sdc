<?php
/**
 * template for displaying single page
 *
 */
get_header();
?>
    <!--<div class="preloader show">
        <div class="preloader__block"></div>
        <span class="preloader__title"><?php the_title()?></span>
    </div>-->
    <div class="page"><!-- main content -->
        <?php the_content() ?>
        <?php get_template_part('templates/main/request', 'phone'); ?>
    </div><!-- main content -->
<?php get_footer(); ?>