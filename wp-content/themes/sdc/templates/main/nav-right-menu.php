<?php
/**
 * template for displaying main menu
 */

global $portfolioPage;
global $contactsPage;
global $eventsPage;
global $clientsPage;
global $directionPage;

/**
 * @var WP_Term $portfolioPage
 * @var WP_Post $contactsPage
 * @var WP_Term $clientsPage
 */

?>
<nav class="nav"><!-- header nav -->
    <ul>
        <li class="<?=sdc_is_front_page() ? 'active' : ''?>">
            <a href="<?=sdc_get_front_url()?>"><?=pll__('Компания')?></a>
        </li>
        <?php if (!empty($portfolioPage)) : ?>
            <li class="<?=(sdc_is_portfolio_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($portfolioPage->cat_ID)?>" id="c_1"><?=$portfolioPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if (!empty($directionPage)) : ?>
            <li class="<?=(sdc_is_direction_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($directionPage->cat_ID)?>">
                    <?=$directionPage->name?>
                </a>
            </li>
        <?php endif; ?>
        <?php if (!empty($clientsPage)) : ?>
            <li class="<?=(sdc_is_clients_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if (!empty($eventsPage)) : ?>
            <li class="<?=(sdc_is_events_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if (!empty($contactsPage)) : ?>
            <li class="<?=(sdc_is_contacts_page() ? 'active' : '')?>">
                <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
            </li>
        <?php endif; ?>
    </ul>
</nav><!-- header nav -->
