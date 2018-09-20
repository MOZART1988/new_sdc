<?php
/**
 * functions.php for theme SDC
*/


if (! function_exists('sdc_main_style')) :
    /**
     * Add styles for theme
     */
    function sdc_main_style() {
        wp_enqueue_style('style', get_stylesheet_uri());
    }

endif;

if (! function_exists('sdc_main_scripts')) :
    /**
     * Add scripts to theme
    */

    function sdc_main_scripts() {

        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, NULL, true );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('libs', get_template_directory_uri() . '/js/libs.js', [], false, true);
        wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', [], false, true );
    }

    add_action( 'wp_enqueue_scripts', 'sdc_main_scripts' );

endif;

if ( ! function_exists( 'sdc_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     */
    function sdc_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
         * If you're building a theme based on Twenty Sixteen, use a find and replace
         * to change 'twentysixteen' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'sdc' );

        add_action( 'wp_enqueue_scripts', 'sdc_main_style' );
        add_action( 'wp_enqueue_scripts', 'sdc_main_scripts');
    }
endif; // sdc setup

add_action( 'after_setup_theme', 'sdc_setup' );

if ( ! function_exists( 'sdc_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     */
    function sdc_the_custom_logo() {
        return '<a href="/" class="logo">
            <img src="'.esc_url( get_template_directory_uri() ).'/img/logo.png"><span>smartdigital</span>
            </a>';
    }
endif;

if (! function_exists('sdc_footer_logo')) :
    /**
     * Displays footer logo
    */

    function sdc_footer_logo() {
        return '<a href="/"><img src="'.esc_url( get_template_directory_uri() ).'/img/logo.png"></a>';
    }

endif;

