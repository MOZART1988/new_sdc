<?php
/**
 * Template breadcumps for events
*/
?>

<div class="breadcrumbs">
    <ul>
        <li><a href="<?=get_home_url()?>"><?=pll__('Главная')?></a></li>
        <li><a href="<?=get_category_link(sdc_get_events_category()->cat_ID)?>"><?=sdc_get_events_category()->name?></a></li>
        <li><a href="#"><?=get_post()->post_title?></a></li>
    </ul>
</div>
