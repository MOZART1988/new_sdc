<?php
/**
 * template for displaying single page
 *
 */
get_header();
?>
    <div class="preloader show">
        <div class="preloader__block"></div>
        <span class="preloader__title"><?php the_title()?></span>
    </div>
    <div class="page"><!-- main content -->
        <section class="contacts"><!-- main contacts -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <?php the_title( '<h2 class="title in">', '</h2>' ); ?>
                    </div>
                    <?php if (sdc_get_contacts_page()) : ?>
                        <div class="col-lg-9 col-md-8">
                            <h3>Наш офис находится в самом центре Алматы. <br> Добраться до нас можно без проблем и пробок.</h3>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row contacts--row">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php if (sdc_get_contacts_page()) : ?>
                            <?php get_template_part('templates/pages/contacts', 'main')?>
                        <?php else : ?>
                            <?php get_template_part('templates/pages/other', 'main'); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section><!-- main contacts -->
        <?php get_template_part('templates/main/request', 'phone'); ?>
    </div><!-- main content -->
<?php get_footer(); ?>