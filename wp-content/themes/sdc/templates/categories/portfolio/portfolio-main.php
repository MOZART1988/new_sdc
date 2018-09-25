<?php
/**
 * template for displaing portfolio category
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
<div class="page"><!-- page content -->
    <div class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h1 class="title"><?=$category->name?></h1>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=$category->category_description?></h3>
                </div>
            </div>
            <?php get_template_part('templates/categories/portfolio/portfolio_categories', 'index'); ?>
            <div class="portfolio-ajax-result">
                <?php if ( $loop->have_posts() ) : ?>
                    <?php $counter = 1; $result = [];?>
                    <?php $counterPost = wp_count_posts('portfolio_item'); ?>
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <?php if ($counter === 2 || $counter === 3 || $counter === 5 || $counter === 6 || $counter === 8 || $counter === 9)  : ?>
                            <?php get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );?>
                        <?php endif; ?>
                        <?php if ($counter === 1)  :?>
                            <div class="row">
                            <?php get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );?>
                        <?php elseif ($counter === 4 || $counter === 7) : ?>
                            </div>
                            <div class="row">
                            <?php get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );?>
                        <?php elseif ($counter === (int)$counterPost->publish || $counter === 9) : ?>
                            </div>
                        <?php endif; ?>

                        <?php $counter++ ?>
                    <?php endwhile;?>
                    <?php
                    $total_pages = $loop->max_num_pages;

                    if ($total_pages > 1){

                        $current_page = max(1, get_query_var('paged'));

                        echo '<div class="pagination"><a href="#" class="back">в самое начало</a>' . paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',

                                'current' => $current_page,
                                'total' => $total_pages,
                                'type' => 'list',
                                'next_text' => '>',
                                'prev_text' => '<',
                            )) . '<a href="#" class="end">в самый конец</a></div>';
                    }
                    ?>
                    <?php wp_reset_postdata();?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- page content -->
