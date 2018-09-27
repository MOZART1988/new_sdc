<?php
/**
 * template for displaing events category
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
    <section class="event second"><!-- main event -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title"><?=$category->name?></h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=$category->category_description?></h3>
                </div>
            </div>
            <?php get_template_part('/templates/categories/events/events-categories', 'index'); ?>
            <div class="row">
                <?php if ($loop->have_posts()): ?>
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <?php get_template_part('/templates/categories/events/events_item', 'index')?>
                    <?php endwhile;?>
                <?php endif; ?>
            </div>
            <?php
            $total_pages = $loop->max_num_pages;

            if ($total_pages > 1){

                $current_page = max(1, get_query_var('paged'));

                echo '<div class="pagination"><a href="#" class="back">'.pll__('в самое начало').'</a>' . paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',

                        'current' => $current_page,
                        'total' => $total_pages,
                        'type' => 'list',
                        'next_text' => '>',
                        'prev_text' => '<',
                    )) . '<a href="#" class="end">'.pll__('в самый конец').'</a></div>';
            }
            ?>
            <?php wp_reset_postdata();?>
        </div>
    </section><!-- main event -->
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- main content -->