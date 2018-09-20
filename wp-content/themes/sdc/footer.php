<?php
/**
 * The template for displaying the footer
 *
 * Displays all of the footer element.
 *
 * @package WordPress
 */
?>
<footer><!-- footer -->
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-6">
                <h6>Компания</h6>
                <ul>
                    <li class="active"><a href="#">О компании</a></li>
                    <li><a href="#">События</a></li>
                    <li><a href="#">Контакты</a></li>
                    <li><a href="#">Вакансии</a></li>
                    <li><a href="#">Клиенты</a></li>
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
