<?php
/**
 * @var WP_Term $category
 */
$taxonomies = [
    'category',
];

$category = sdc_get_portfolio_category();
$categories = get_categories([
    'parent' => $category->cat_ID,
    'hide_empty' => 1
]);

$categoriesFinal = [];

$postType = get_post_type(get_post());


if (is_single()) {

    if ($postType === 'portfolio_item') {
        $clientId = get_post_meta(get_post()->ID, 'pt_client_id_original')[0];
    } else {
        $clientId = get_post()->ID;
    }

    foreach ($categories as $item) {
        $loop = new WP_Query([
            'post_type'=>'portfolio_item',
            'posts_per_page' => -1,
            'lang' => pll_current_language(),
            'meta_key' => 'pt_client_id_original',
            'meta_value' => !empty($clientId) ? $clientId : null,
            'cat' => $item->cat_ID
        ]);

        if (!empty($loop->posts)) {
            $categoriesFinal[] = $item;
        }

    }

} else {
    $categoriesFinal = $categories;
}





?>
<?php if (!empty($categoriesFinal)) : ?>
<div class="portfolio__nav" data-post-id="<?=get_post()->ID?>">
    <ul>
        <li class="active portfolio-filter"><a data-id="all" href="#all"><?php _e('Все', 'SDC'); ?></a></li>
        <?php foreach ($categoriesFinal as $item) : ?>
            <li class="portfolio-filter"><a data-id="<?=$item->cat_ID?>" href="#<?=$item->name?>"><?=$item->name?></a></li>
        <?php endforeach; ?>

    </ul>
</div>
<select class="dropdown">
    <option value="all"><?php _e('Все', 'SDC'); ?></option>
    <?php foreach ($categoriesFinal as $item) : ?>
        <option value="<?=$item->cat_ID?>"><?=$item->name?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>