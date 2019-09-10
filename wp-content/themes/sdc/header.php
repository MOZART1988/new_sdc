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
    <span class="slogan"><?=pll__('Агентство рекламы и маркетинга')?></span><!-- header slogan -->
    <div class="langs"><!-- header langs -->
        <ul><?php pll_the_languages();?></ul>
    </div><!-- header langs -->
    <div class="phones"><!-- header phones -->
        <ul>
            <li>
                <a href="#" data-toggle="modal" data-target="#modal--call">
                    <span><?=get_theme_mod('phone_code', '(+7 727)')?></span>
                    <?=get_theme_mod('phone', '350-57-60')?>
                </a>
            </li>
        </ul>
        <a href="#" data-toggle="modal" data-target="#modal--call" class="call"><?=pll__('Перезвонить?')?></a>
    </div><!-- header phones -->
    <?php get_template_part('templates/main/nav-main', 'menu') ?>
    <?php get_template_part('templates/main/nav-right', 'menu')?>
</header><!-- header -->
