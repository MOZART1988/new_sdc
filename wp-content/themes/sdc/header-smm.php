<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 22.11.18
 * Time: 12:34
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/libs.css">
    <?php wp_head(); ?>
</head>
<body class="<?php echo sdc_body_class(); ?>">
<header class="header">
    <a href="index.html" class="logo">
        <img class="logo3" src="/img/logo2.png" alt="logo">
        <img class="logo2" src="/img/logo1.png" alt="logo">
        <img class="logo1" src="/img/logo3.png" alt="logo">
    </a>
    <nav class="nav--lng">
        <ul>
            <li class="active"><a href="#">О компании</a></li>
            <li><a href="#">Портфолио</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Клиенты</a></li>
            <li><a href="#">Событиея</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </nav>
    <nav class="nav--lng--cat">
        <a href="#" class="close"></a>
        <ul class="nav--lng--main">
            <li class="active"><a href="#">О компании</a></li>
            <li><a href="#">Портфолио</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Клиенты</a></li>
            <li><a href="#">Событиея</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
        <ul>
            <li class="active"><a href="#"><span>01</span>СММ</a></li>
            <li><a href="#"><span>02</span>Таргетированная реклама</a></li>
            <li><a href="#"><span>03</span>Email рассылка или же Email маркетинг</a></li>
            <li><a href="#"><span>04</span>Баннерная реклама</a></li>
            <li><a href="#"><span>05</span>Контекстная реклама</a></li>
            <li><a href="#"><span>06</span>SEO</a></li>
            <li><a href="#"><span>07</span>Копирайтинг</a></li>
            <li><a href="#"><span>08</span>Создание сайтов</a></li>
            <li><a href="#"><span>09</span>Поддержка сайта</a></li>
            <li><a href="#"><span>10</span>Создание видеороликов</a></li>
        </ul>
    </nav>
    <a href="#" class="nav--lng--cat--btn">
        <span></span>
        <span></span>
        <span></span>
    </a>
</header>
