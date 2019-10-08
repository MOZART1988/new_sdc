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
                <?php if (sdc_check_if_children_exists($portfolioPage)) : ?>
                    <li class="submenu <?=sdc_is_portfolio_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($portfolioPage->cat_ID)?>"><?=$portfolioPage->name?></a>
                        <?php
                            $children = get_terms([
                                'hide_empty' => true,
                                'taxonomy' => 'category',
                                'parent' => $portfolioPage->term_id
                            ]);
                        ?>
                        <ul <?=!sdc_is_portfolio_page() ? "style='display:none'" : ''?>>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=esc_attr(get_term_link($category, 'category'))?>"><?=$category->name?></a>
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

            <?php if ($directionPage !== false) : ?>
                <li class="li <?=(sdc_is_direction_page() ? 'active' : '')?>">
                    <a href="<?=get_category_link($directionPage->cat_ID)?>"><?=$directionPage->name?></a>
                </li>
            <?php endif; ?>

            <?php if ($clientsPage !== false) : ?>
                <?php if (sdc_check_if_children_exists($clientsPage)) : ?>
                    <li class="submenu <?=sdc_is_clients_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
                        <?php
                        $children = get_terms([
                            'hide_empty' => true,
                            'taxonomy' => 'category',
                            'parent' => $clientsPage->term_id
                        ]);
                        ?>
                        <ul <?=!sdc_is_clients_page() ? "style='display:none'" : ''?>>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=esc_attr(get_term_link($category, 'category'))?>">
                                        <?=$category->name?>
                                    </a>
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
                <?php if (sdc_check_if_children_exists($eventsPage)) : ?>
                    <li class="submenu <?=sdc_is_events_page() ? 'active' : ''?>">
                        <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
                        <?php
                        $children = get_terms([
                            'hide_empty' => true,
                            'taxonomy' => 'category',
                            'parent' => $eventsPage->term_id
                        ]);
                        ?>
                        <ul <?=!sdc_is_events_page() ? "style='display:none'" : ''?>>
                            <?php foreach ($children as $term_id) : ?>
                                <?php $category = get_term($term_id); ?>
                                <li class="<?=sdc_is_current_category($category->slug) ? 'active' : ''?>">
                                    <a href="<?=esc_attr(get_term_link($category, 'category'))?>">
                                        <?=$category->name?>
                                    </a>
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