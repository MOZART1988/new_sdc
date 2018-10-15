<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 */
get_header(); ?>
<!--<div class="preloader show">
    <div class="preloader__block"></div>
    <span class="preloader__title"><?=pll__('Smartdigital')?></span>
</div>-->
<div class="main"><!-- main content -->
    <section class="banner"><!-- main banner -->
        <img src="/img/img-1.jpg">
        <span class="banner__title"></span>
    </section><!-- main banner -->
    <section class="about"><!-- main about -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <h2 class="title">О компании</h2>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <h3><?=pll__('У нас работаю фанаты своего дела. Профессиональная команда, которая способна справиться с самой сложной задачей.')?></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 left">
                    <img src="/img/img-2.jpg">
                    <span>Мы сформируем вам правильную стратегию ведения рекламы и продвижению сайта  в интернете, что обеспечивает максимальное увеличение продаж на любом уровне. Благодаря продвижению сайта и интернет рекламе вы получите стабильный поток клиентов.</span>
                </div>
                <div class="col-lg-9 col-md-8 right">
                    <ul class="about__nav">
                        <li class="active"><a href="#">Почему мы?</a></li>
                        <li><a href="#">Как мы работаем?</a></li>
                        <li><a href="#">Миссия компании</a></li>
                    </ul>
                    <select class="dropdown">
                        <option value="1" selected>Почему мы?</option>
                        <option value="2">Как мы работаем?</option>
                        <option value="3">Миссия компании</option>
                    </select>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="about__img"><img src="/img/img-3.png"></div>
                            <div class="about__text">
                                <h6>Аналитика</h6>
                                <p>Сегментация и персонализация Сокращение сложности Машинное обучение Оптимизация</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="about__img"><img src="/img/img-4.png"></div>
                            <div class="about__text">
                                <h6>Опыт взаимодействия</h6>
                                <p>HCD подход Отзывчивость пользователей Идеи и инновационные спринты Этнография</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="about__img"><img src="/img/img-5.png"></div>
                            <div class="about__text">
                                <h6>Лаборатория дизайна</h6>
                                <p>Быстрое создание прототипов Дизайн UI/UX CJM Тестирование на удобства</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="about__img"><img src="/img/img-6.png"></div>
                            <div class="about__text">
                                <h6>Маркетинг</h6>
                                <p>Маркетинговый тест и обучение Адаптация технологий Мнение клиентов PMF</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="about__img"><img src="/img/img-7.png"></div>
                            <div class="about__text">
                                <h6>Лаборатория разработки</h6>
                                <p>Инновационная структура Готовые цифровые IT решения Разработка инструментов Пригодность концепции</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- main about -->
    <?php get_template_part('templates/main/request', 'phone'); ?>
</div><!-- main content -->

<?php get_footer(); ?>
