<?php
/**
 * @var WP_Term $category
 */
$taxonomies = array(
    'category',
);
$category = sdc_get_portfolio_category();
$categories = get_categories(['parent' => $category->cat_ID, 'hide_empty' => 0]);

?>
<?php if (!empty($categories)) : ?>
<div class="portfolio__nav">
    <ul>
        <li><a href="#"><?php _e('Все', 'SDC'); ?></a></li>
        <?php foreach ($categories as $item) : ?>

            <li><a href="#"><?=$item->name?></a></li>
        <?php endforeach; ?>

    </ul>
</div>
<select class="dropdown">
    <option value="1"><?php _e('Все', 'SDC'); ?></option>
    <?php $counter = 2 ; ?>
    <?php foreach ($categories as $item) : ?>
        <option value="<?=$counter?>"><?=$item->name?></option>
        <?php $counter++; ?>
    <?php endforeach; ?>
</select>
<?php endif; ?>