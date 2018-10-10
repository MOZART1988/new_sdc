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
 * @var WP_Term $eventsPage
 */

?>
<a href="#" class="nav--btn">
    <span></span>
    <span></span>
    <span></span>
</a>
<nav class="nav--more"><!-- header nav more -->
    <div class="container">
        <ul>
            <li class="<?=sdc_is_front_page() ? 'active' : 'li'?>">
                <a href="/"><?=pll__('Компания')?></a>
            </li>

            <?php if ($portfolioPage !== false) : ?>
                <?php if (sdc_is_portfolio_page() && sdc_check_if_children_exists($portfolioPage)) : ?>
                    <li class="submenu <?=sdc_is_portfolio_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($portfolioPage->cat_ID)?>"><?=$portfolioPage->name?></a>
                        <?php $children = get_term_children($portfolioPage->term_id, 'category'); ?>
                        <ul>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=get_category_link($category->cat_ID)?>"><?=$category->name?></a>
                                </li>
                            <?php endforeach ; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="<?=sdc_is_portfolio_page() ? 'active' : 'li'?>">
                        <a href="<?=get_category_link($portfolioPage->cat_ID)?>"><?=$portfolioPage->name?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <li class="li"><a href="pageDirection.html">Услуги</a></li>

            <?php if ($clientsPage !== false) : ?>
                <?php if (sdc_is_clients_page() && sdc_check_if_children_exists($clientsPage)) : ?>
                    <li class="submenu <?=sdc_is_clients_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
                        <?php $children = get_term_children($clientsPage->term_id, 'category'); ?>
                        <ul>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=get_category_link($category->cat_ID)?>"><?=$category->name?></a>
                                </li>
                            <?php endforeach ; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="<?=sdc_is_clients_page() ? 'active' : 'li'?>">
                        <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($eventsPage !== false) : ?>
                <?php if (sdc_is_events_page() && sdc_check_if_children_exists($eventsPage)) : ?>
                    <li class="submenu <?=sdc_is_events_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
                        <?php $children = get_term_children($eventsPage->term_id, 'category'); ?>
                        <ul>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=get_category_link($category->cat_ID)?>"><?=$category->name?></a>
                                </li>
                            <?php endforeach ; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="<?=sdc_is_events_page() ? 'active' : 'li'?>">
                        <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($contactsPage !== false) : ?>
                <li class="<?=(sdc_is_contacts_page() ? 'active' : '')?>">
                    <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <a href="#" class="close">
        <span></span>
        <span></span>
    </a>
</nav><!-- header nav more -->