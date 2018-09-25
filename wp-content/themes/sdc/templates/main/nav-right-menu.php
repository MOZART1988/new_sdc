<?php
/**
 * template for displaying main menu
 */

$portfolioPage = sdc_get_portfolio_category();
$contactsPage = sdc_get_contacts_page();

?>
<nav class="nav"><!-- header nav -->
    <ul>
        <li><a href="#">Компания</a></li>
        <?php if (!empty($portfolioPage)) : ?>
            <li><a href="<?=get_category_link($portfolioPage->cat_ID)?>" id="c_1">Портфолио</a></li>
        <?php endif; ?>
        <li><a href="#">Услуги</a></li>
        <li><a href="#">Клиенты</a></li>
        <li><a href="#">События</a></li>
        <?php if (!empty($contactsPage)) : ?>
            <li><a href="#">Контакты</a></li>
        <?php endif; ?>
    </ul>
</nav><!-- header nav -->
