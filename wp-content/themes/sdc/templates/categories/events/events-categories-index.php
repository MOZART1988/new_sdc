<?php
/**
 * @var WP_Term $category
 */
$taxonomies = array(
    'category',
);
$category = sdc_get_events_category();
$categories = get_categories(['parent' => $category->cat_ID, 'hide_empty' => 0]);

?>
<?php if (!empty($categories)) : ?>
    <div class="portfolio__nav">
        <ul>
            <li class="active"><a data-id="all" href="#"><?php _e('Все', 'SDC'); ?></a></li>
            <?php foreach ($categories as $item) : ?>
                <li><a data-id="<?=$item->cat_ID?>" href="#"><?=$item->name?></a></li>
            <?php endforeach; ?>

        </ul>
    </div>
    <select class="dropdown">
        <option value="all"><?php _e('Все', 'SDC'); ?></option>
        <?php foreach ($categories as $item) : ?>
            <option value="<?=$item->cat_ID?>"><?=$item->name?></option>
        <?php endforeach; ?>
    </select>
<?php endif; ?>