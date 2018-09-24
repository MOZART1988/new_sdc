<?php
/**
 * The template for displaying portfolio category
 *
 * @var WP_Term $category
 * @package WordPress
 */
$category = sdc_get_portfolio_category();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type'=>'portfolio_item',
    'posts_per_page' => 6,
    'paged' => $paged,
    'lang' => pll_current_language()
];

$loop = new WP_Query( $args );

get_header(); ?>
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
            <?php get_template_part('portfolio_categories', 'index'); ?>
            <?php if ( $loop->have_posts() ) : ?>
                <?php $counter = 1; $result = [];?>
                <?php $counterPost = wp_count_posts('portfolio_item'); ?>
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <?php if ($counter === 2 || $counter === 3 || $counter === 5 || $counter === 6) : ?>
                        <?php get_template_part( 'portfolio_item', 'index' );?>
                    <?php endif; ?>
                    <?php if ($counter === 1)  :?>
                        <div class="row">
                        <?php get_template_part( 'portfolio_item', 'index' );?>
                    <?php elseif ($counter === 4) : ?>
                        </div>
                        <div class="row">
                        <?php get_template_part( 'portfolio_item', 'index' );?>
                    <?php elseif ($counter === (int)$counterPost->publish || $counter === 6) : ?>
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
            <!--<div class="pagination">
                <a href="#" class="back">в самое начало</a>
                <ul>
                    <li class="prev"><a href="#"></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li class="next"><a href="#"></a></li>
                </ul>
                <a href="#" class="end">в самый конец</a>
            </div>-->
        </div>
    </div>
    <div id="modal--call" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    <h4>Заказать обратный звонок</h4>
                    <form>
                        <input type="text" placeholder="Имя" required="required">
                        <input type="text" placeholder="Контактный номер" name="tel" required="required">
                        <textarea rows="5" placeholder="Сообщение" required="required"></textarea>
                        <input type="submit" class="btn" value="Отправить">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="call--btn" data-toggle="modal" data-target="#modal--call">
        <span class="bg"></span>
    </a>
    <div class="help">
        <h5>Закажите услугу</h5>
        <p>или получите консультацию</p>
        <span class="close"></span>
    </div>
</div><!-- page content -->

<?php get_footer(); ?>

