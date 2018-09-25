<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the content div.
 *
 * @package WordPress
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
<header><!-- header -->
    <?php if (sdc_is_front_page()) : ?>
        <a href="/" class="logo">
            <img src="<?=esc_url( get_template_directory_uri() )?>/img/logo.png"><span>smartdigital</span>
        </a>
    <?php else : ?>
        <a href="/" class="logo">
            <img src="<?=esc_url( get_template_directory_uri() )?>/img/logo-1.png"><span>smartdigital</span>
        </a>
    <?php endif; ?>
    <span class="slogan"><?php _e('Агентство рекламы и маркетинга', 'SDC')?></span><!-- header slogan -->
    <div class="langs"><!-- header langs -->
        <ul><?php pll_the_languages();?></ul>
    </div><!-- header langs -->
    <div class="phones"><!-- header phones -->
        <ul>
            <li><a href="tel:+7 (727)350-57-60"><span>(+7 727)</span> 350-57-60</a></li>
        </ul>
        <a href="tel:+7 (727)350-57-60" class="call"><?php _e('Перезвонить?', 'SDC')?></a>
    </div><!-- header phones -->
    <a href="#" class="nav--btn">
        <span></span>
        <span></span>
        <span></span>
    </a>
    <nav class="nav--more"><!-- header nav more -->
        <div class="container">
            <ul>
                <li class="li"><a href="#">Компания</a></li>
                <li class="submenu active">
                    <a href="pagePortfolio.html">Портфолио</a>
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
                </li>
                <li class="li"><a href="pageDirection.html">Услуги</a></li>
                <li class="li"><a href="pageClientage.html">Клиенты</a></li>
                <li class="li"><a href="pageEvent.html">События</a></li>
                <li class="li"><a href="pageContacts.html">Контакты</a></li>
            </ul>
        </div>
        <a href="#" class="close">
            <span></span>
            <span></span>
        </a>
    </nav><!-- header nav more -->
    <nav class="nav"><!-- header nav -->
        <?php
        $categoryId = sdc_get_portfolio_category()->cat_ID;
        ?>
        <ul>
            <li class="active"><a href="#">Компания</a></li>
            <li><a href="<?=get_category_link($categoryId)?>" id="c_1">Портфолио</a></li>
            <li><a href="#">Услуги</a></li>
            <li><a href="#">Клиенты</a></li>
            <li><a href="#">События</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </nav><!-- header nav -->
</header><!-- header -->
