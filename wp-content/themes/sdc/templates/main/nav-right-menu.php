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
        <li><a href="#">Компания</a></li>
        <?php if ($portfolioPage !== null) : ?>
            <li class="<?=(strpos($_SERVER['REQUEST_URI'], 'portfolio') !== false ? 'active' : '')?>">
                <a href="<?=get_category_link($portfolioPage->cat_ID)?>" id="c_1"><?=$portfolioPage->name?></a>
            </li>
        <?php endif; ?>
        <li><a href="#">Услуги</a></li>
        <?php if ($clientsPage !== null) : ?>
        <li class="<?=(strpos($_SERVER['REQUEST_URI'], 'clients') !== false ? 'active' : '')?>">
            <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
        </li>
        <?php endif; ?>
        <?php if ($eventsPage !== null) : ?>
            <li class="<?=(strpos($_SERVER['REQUEST_URI'], 'events') !== false ? 'active' : '')?>">
                <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
            </li>
        <?php endif; ?>
        <?php if ($contactsPage !== null) : ?>
            <li class="<?=(strpos($_SERVER['REQUEST_URI'], 'contacts') !== false ? 'active' : '')?>">
                <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
            </li>
        <?php endif; ?>
    </ul>
</nav><!-- header nav -->
