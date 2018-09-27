<?php
/**
 * template for displaing direction category
 * @var array $template_args
 */

$category = $template_args['category'];
$loop = $template_args['loop'];
/**
 * @var WP_Query $loop
 * @var WP_Term $categpry
 */
?>
<div class="preloader show">
    <div class="preloader__block"></div>
    <span class="preloader__title"><?=$category->name?></span>
</div>
<div class="page"><!-- main content -->
    <section class="direction"><!-- main direction -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title"><?=$category->name?></h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=$category->category_description?></h3>
                </div>
            </div>
        </div>
        <div class="slider direction__slider">
            <?php if ($loop->have_posts()) : ?>
                <?php $counter = 1; $mainDivCounter = 1;  $rowCounter = 1; $result = [];?>
                <?php $counterPost = wp_count_posts('direction_item'); ?>
                <?php while($loop->have_posts()) : $loop->the_post();  ?>
                        <?php if ($counter === 1) : ?>
            <div><div class="row">
                    <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                       <?php endif; ?>
                    <?php if ($counter % 2 === 0 && $counter % 4 !== 0): ?>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                </div><div class="row">
                    <?php endif; ?>
                    <?php if ($counter % 3 === 0 || $counter % 5 === 0) : ?>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                    <?php endif; ?>
                    <?php if ($counter % 4 === 0 && $counter !== $counterPost->publish) : ?>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
                        </div></div><div><div class="row">
                    <?php endif; ?>
                    <?php if ($counter === $counterPost->publish - 1) : ?>
                        <?php get_template_part( 'templates/categories/direction/direction_item', 'index' );?>
        </div>
                    <?php endif; ?>
        <?php $counter++; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div>


