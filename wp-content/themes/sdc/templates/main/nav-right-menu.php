<?php
/**
 * template for displaying main menu
 */

$portfolioPage = sdc_get_portfolio_category();
$contactsPage = sdc_get_contacts_page();
$eventsPage = sdc_get_events_category();
$clientsPage = sdc_get_clients_category();

/**
 * @var WP_Term $portfolioPage
 * @var WP_Post $contactsPage
 * @var WP_Term $clientsPage
 */

?>
<nav class="nav"><!-- header nav -->
    <ul>
        <li class="<?=sdc_is_front_page() ? 'active' : ''?>">
            <a href="/"><?=pll__('Компания')?></a>
        </li>
        <?php if ($portfolioPage !== null) : ?>
            <li class="<?=(sdc_is_portfolio_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($portfolioPage->cat_ID)?>" id="c_1"><?=$portfolioPage->name?></a>
            </li>
        <?php endif; ?>
        <li><a href="#">Услуги</a></li>
        <?php if ($clientsPage !== null) : ?>
            <li class="<?=(sdc_is_clients_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if ($eventsPage !== null) : ?>
            <li class="<?=(sdc_is_events_page() ? 'active' : '')?>">
                <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if ($contactsPage !== null) : ?>
            <li class="<?=(sdc_is_contacts_page() ? 'active' : '')?>">
                <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
            </li>
        <?php endif; ?>
    </ul>
</nav><!-- header nav -->
