<?php
/**
 * The template for displaying the footer
 *
 * Displays all of the footer element.
 *
 * @package WordPress
 */

global $portfolioPage;
global $contactsPage;
global $eventsPage;
global $clientsPage;

/**
 * @var WP_Term $portfolioPage
 * @var WP_Post $contactsPage
 * @var WP_Term $clientsPage
 * @var WP_Term $eventsPage
 */

?>
<footer><!-- footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <h6><?=pll__('Компания')?></h6>
                <ul>
                    <li class="<?=sdc_is_front_page() ? 'active' : ''?>">
                        <a href="/"><?=pll__('О компании')?></a>
                    </li>
                    <?php if ($eventsPage !== false) : ?>
                        <li class="<?=(sdc_is_events_page() ? 'active' : '')?>">
                            <a href="<?=get_category_link($eventsPage->cat_ID)?>"><?=$eventsPage->name?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($contactsPage !== false) : ?>
                        <li class="<?=(sdc_is_contacts_page() ? 'active' : '')?>">
                            <a href="<?=get_permalink($contactsPage)?>"><?=$contactsPage->post_title?></a>
                        </li>
                    <?php endif; ?>
                    <li><a href="#">Вакансии</a></li>
                    <?php if ($clientsPage !== false) : ?>
                        <li class="<?=(sdc_is_clients_page() ? 'active' : '')?>">
                            <a href="<?=get_category_link($clientsPage->cat_ID)?>"><?=$clientsPage->name?></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-3 col-sm-6">
                <h6>Услуги</h6>
                <ul>
                    <li class="active"><a href="#">СММ</a></li>
                    <li><a href="#">Таргетированная реклама</a></li>
                    <li><a href="#">Email рассылка или же Email маркетинг</a></li>
                    <li><a href="#">Баннерная реклама</a></li>
                    <li><a href="#">Контекстная реклама</a></li>
                    <li><a href="#">SEO</a></li>
                    <li><a href="#">Копирайтинг</a></li>
                    <li><a href="#">Создание сайтов</a></li>
                    <li><a href="#">Поддержка сайта</a></li>
                    <li><a href="#">Создание видеороликов</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-12 col--files">
                <h6>Полезная информация</h6>
                <ul>
                    <li><a href="#">Скачать презентацию по СММ <span>195 кб</span></a></li>
                    <li><a href="#">Скачать презентацию по разработке сайтов <span>85 кб</span></a></li>
                    <li><a href="#">Скачать презентацию по маркетинговому консалтингу <span>150 кб</span></a></li>
                </ul>
            </div>
            <div class="col-md-3 col-sm-12 col--logo">
                <?=sdc_footer_logo()?>
                <p><?php _e('© 2012–2018 Рекламное агентство', 'SDC'); ?> <br> <?php _e('Smart Digital Consulting', 'SDC'); ?></p>
            </div>
        </div>
    </div>
</footer><!-- footer -->

<?php wp_footer(); ?>

</body>
</html>
