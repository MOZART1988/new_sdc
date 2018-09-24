<?php
/**
 * functions.php for theme SDC
*/

/**
 * Элемент портфолио
 * @return WP_Post_Type
*/
function portfolio_item() {
    register_post_type('portfolio_item', [
        'labels' => [
            'name'            => __( 'Элементы портфолио' ),
            'singular_name'   => __( 'Портфолио' ),
            'add_new'         => __( 'Добавить' ),
            'add_new_item'    => __( 'Добавить новый элемент' ),
            'edit'            => __( 'Редактировать' ),
            'edit_item'       => __( 'Редактировать элемент' ),
            'new_item'        => __( 'Новый элемент' ),
            'all_items'       => __( 'Все элементы портфолио' ),
            'view'            => __( 'Просмотреть' ),
            'view_item'       => __( 'Просмотреть элемент' ),
            'search_items'    => __( 'Поиск' ),
            'not_found'       => __( 'Не удалось найти' ),
        ],
        'public' => true, // show in admin panel?
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'taxonomies' => ['category'],
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-images-alt',
        'rewrite' => ['slug' => 'portfolio'],
    ]);
}
add_action( 'init', 'portfolio_item' );


/**
 * Dыбор цвета заголовка в элементы портфолио на странице всех элементов портфолио
*/

function portfolio_title_color() {
    add_meta_box(
        'pt_title_color',
        __('Цвет заголовка'),
        'portfolio_title_color_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_title_color');


function portfolio_title_color_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_title_color');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <select name="pt_title_color_original" id="pt_title_color_original">
        <option value="white" <?=(isset($links_stored_meta['pt_title_color_original']) &&
        ($links_stored_meta['pt_title_color_original'][0] === 'white') ? 'selected' : '')?>>Светлый заголовок</option>
        <option value="dark" <?=(isset($links_stored_meta['pt_title_color_original']) &&
        ($links_stored_meta['pt_title_color_original'][0] === 'dark') ? 'selected' : '')?>>Темный заголовок</option>
    </select>

    <?php
}

/**
 * Cохранение
*/

function portfolio_title_color_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pt_title_color' ] ) && wp_verify_nonce( $_POST[ 'pt_title_color' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pt_title_color_original' ] ) ) {
        update_post_meta( $post_id, 'pt_title_color_original', sanitize_text_field( $_POST[ 'pt_title_color_original' ] ) );
    }
}

add_action('save_post', 'portfolio_title_color_save');


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
        add_theme_support('post-thumbnails');

        add_image_size( 'portfolio', 398, 326, true );
        add_image_size('very-small', 50, 50, true);
    }
endif; // sdc setup

add_action( 'after_setup_theme', 'sdc_setup' );

if (! function_exists('sdc_footer_logo')) :
    /**
     * Displays footer logo
     * @return string
    */

    function sdc_footer_logo() {
        return '<a href="/"><img src="'.esc_url( get_template_directory_uri() ).'/img/logo.png"></a>';
    }

endif;

if (! function_exists('sdc_is_front_page')) :
    /**
     * Check if page is home
     * @return bool
    */

    function sdc_is_front_page(){
        $isfrontpage = false;

        $current = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $site = get_site_url();
        $site = str_replace('http://', '', $site);
        $site = str_replace('https://', '', $site);
        $site = str_replace('www', '', $site);
        if( $site == $current || $site . '/' == $current ){
            $isfrontpage = true;
        }


        return $isfrontpage;
    }

endif;

if (! function_exists('sdc_body_class')) :
    /**
     * set body class
     * @return string
    */

    function sdc_body_class() {
        if (sdc_is_front_page()) {
            return '';
        }

        return 'body';
    }

endif;

if (! function_exists('sdc_get_portfolio_category')) :
    /**
     * get portfolio category
     * @return []] $category
    */

    function sdc_get_portfolio_category(){
        $category = !empty(get_category_by_slug('portfolio')) ?
            get_category_by_slug('portfolio') :
            get_category_by_slug('portfolio-' . pll_current_language());

        return $category;
    }

endif;

