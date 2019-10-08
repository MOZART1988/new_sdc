<?php
/**
 * template for displaing clients category
 * @var array $template_args
 */

$category = $template_args['category'];
$loop = $template_args['loop'];
$paged = $template_args['paged'];

/**
 * @var WP_Query $loop
 * @var WP_Term $categpry
 */

$isClientsRootCategory = (get_queried_object()->slug == 'clients' ||
    (strpos(get_queried_object()->slug, 'clients') !== false)
) ? true : false;

$categories = get_categories([
    'parent' => sdc_get_clients_category()->cat_ID,
    'hide_empty' => true
]);

?>
<div class="page"><!-- main content -->
    <section class="clientage"><!-- main clientage -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title"><?=$category->name?></h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=$category->category_description?></h3>
                    <select class="dropdown">
                        <option value="all" <?=$isClientsRootCategory ? 'active' : ''?>>Все отрасли</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?=$category->cat_ID?>"><?=$category->cat_name?></option>
                        <?php endforeach ; ?>
                    </select>
                </div>
            </div>
            <div class="clients-ajax-result">
                <?php if ($loop->have_posts()): ?>
                    <div class="clientage__block">
                        <?php while($loop->have_posts()): $loop->the_post(); ?>
                            <?php get_template_part('/templates/categories/clients/clients_item', 'index'); ?>
                        <?php endwhile; ?>
                    </div>
                    <?php
                    $total_pages = $loop->max_num_pages;

                    if ($total_pages > 1){

                        $current_page = max(1, $paged);

                        $params = [
                            'current' => $current_page,
                            'total' => $total_pages,
                            'type' => 'list',
                            'next_text' => '>',
                            'prev_text' => '<',
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%/',
                            'prev_next' => false,
                        ];

                        echo '<div class="pagination">
                                <a href="'.get_category_link(sdc_get_clients_category()->cat_ID).'" class="back">'.pll__('в самое начало').'</a>' .
                                    paginate_links($params)
                                . '<a href="'.get_category_link(sdc_get_clients_category()->cat_ID).'page/'.$loop->max_num_pages.'/" class="end">'.pll__('в самый конец').'</a></div>';
                    }
                    ?>
                <?php endif; ?>

                <?php wp_reset_postdata();?>
            </div>
        </div>
    </section><!-- main clientage -->
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- main content -->
