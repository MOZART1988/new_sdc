<?php
/**
 * functions.php for theme SDC
*/

/**
 * Adding AJAX var
 */
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 );
function myajax_data(){
    wp_localize_script( 'main', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );

}

/**
 * AJAX requests
*/

/**
 *  Загрузка элементов по портфолио по отдельной категории
*/
add_action('wp_ajax_load_items_by_portfolio_category', 'load_items_by_portfolio_category_callback');
add_action('wp_ajax_nopriv_load_items_by_portfolio_category', 'load_items_by_portfolio_category_callback');
add_action( 'wp_footer' , 'load_items_by_portfolio_category', 99);

function load_items_by_portfolio_category() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
           $('body').on('click', '.portfolio__nav a', function(){

               $('.portfolio__nav li').removeClass('active');
               $(this).parent().addClass('active');

               var data = {
                   action: 'load_items_by_portfolio_category',
                   id: $(this).data('id')
               };
                $.ajax({
                    url: myajax.url,
                    data: data,
                    type: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        $('.portfolio-ajax-result').html(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
           });
        });
    </script>
    <?php
}

function load_items_by_portfolio_category_callback() {

    if (empty($_GET['id'])) {
        wp_die();
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = [
        'post_type'=>'portfolio_item',
        'posts_per_page' => 9,
        'paged' => $paged,
        'lang' => pll_current_language()
    ];

    if ($_GET['id'] !== 'all') {
        $args = [
            'post_type'=>'portfolio_item',
            'posts_per_page' => 9,
            'paged' => $paged,
            'lang' => pll_current_language(),
            'cat' => $_GET['id']
        ];
    }

    $loop = new WP_Query( $args );

    if ($loop->have_posts()) {
        $counter = 1;
        $counterPost = wp_count_posts('portfolio_item');
        while ($loop->have_posts()) {
            $loop->the_post();
            if ($counter === 2 || $counter === 3 || $counter === 5 || $counter === 6 || $counter === 8 || $counter === 9) {
                get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );
            }
            if ($counter === 1) {
                echo '<div class="row">';
                get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );
            } elseif ($counter === 4 || $counter === 7) {
                echo '</div>
                <div class="row">';
                get_template_part( 'templates/categories/portfolio/portfolio_item', 'index' );
            } elseif ($counter === (int)$counterPost->publish || $counter === 9) {
                echo '</div>';
            }

            $counter++;
        }

        $total_pages = $loop->max_num_pages;

        if ($total_pages > 1){

            $current_page = max(1, get_query_var('paged'));

            echo '<div class="pagination"><a href="#" class="back">в самое начало</a>' . paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',

                    'current' => $current_page,
                    'total' => $total_pages,
                    'type' => 'list',
                    'next_text' => '>',
                    'prev_text' => '<',
                )) . '<a href="#" class="end">в самый конец</a></div>';
        }

        wp_reset_postdata();
    }

    wp_die();
}

/**
 * Отправка формы обратный звонок
*/

add_action('wp_ajax_send_request_phone_form', 'send_request_phone_form_callback');
add_action('wp_ajax_nopriv_send_request_phone_form', 'send_request_phone_form_callback');
add_action( 'wp_footer' , 'send_request_phone_form', 99);

function send_request_phone_form() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('submit', '#requestPhoneForm', function(e){

                e.preventDefault();
                var form = $(this);
                var data = {
                    action: 'send_request_phone_form',
                    form: $(this).serialize(),
                };

                $.ajax({
                    url: myajax.url,
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                    success: function (data) {
                        form.find('input[type=text]').val('');
                        form.find('textarea').val('');
                        form.after('<br><p style="color:green">'+data.message+'</p>');
                    },
                    error: function (data) {
                        console.log(data);
                        alert('error');
                    }
                });

                return false;
            });
        });
    </script>
    <?php
}

function send_request_phone_form_callback() {
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['requestPhoneForm'];
        if (!empty($form['name']) && !empty($form['tel']) && !empty($form['message'])) {
            $body = '
                <p>Имя - '.$form['name'].'</p>
                <p>Телефон - '.$form['tel'].'</p>
                <p>Сообщение - '.$form['message'].'</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - перезвоните мне', $body)) {
                wp_send_json(
                    ['success' => true, 'message' => 'Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время']
                );
            }

            wp_send_json(
                ['success' => false, 'message' => 'Произошла ошибка, попробуйте позже']
            );
        }
    } else {
        wp_send_json(1);

    }
}


/**
 * Элемент портфолио в админке
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

/**
 * SDC THEME SETUP
 */

if (! function_exists('sdc_main_style')) :
    /**
     * Add styles for theme
     */
    function sdc_main_style() {
        wp_enqueue_style('style', get_stylesheet_uri());
    }

endif;


if (! function_exists('wpse27856_set_content_type')) {
    function wpse27856_set_content_type(){
        return "text/html";
    }
}


if (! function_exists('sdc_main_scripts')) :
    /**
     * Add scripts to theme
    */

    function sdc_main_scripts() {

        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.js', false, NULL, true );
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('libs', get_template_directory_uri() . '/js/libs.js', [], false, true);
        wp_enqueue_script('ymaps', get_template_directory_uri() . '/js/ymaps.js', [], false, true);
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


        add_filter( 'wp_mail_content_type', 'wpse27856_set_content_type' );

        /**
         * register strings for polylang
        */

        /**
         * index.php
        */
        pll_register_string('Название сайта', 'Smartdigital', 'SDC');
        pll_register_string(
                'Слоган сайта',
            'У нас работаю фанаты своего дела. Профессиональная команда, которая способна справиться с самой сложной задачей.',
            'SDC');
        pll_register_string(
                'Заказать обратный звонок',
                'Заказать обратный звонок',
                'SDC'
        );

        /**
         * request-phone.php
        */
    }
endif; // sdc setup

add_action( 'after_setup_theme', 'sdc_setup' );


/**
 * ADDITIONAL FUNCTIONS
*/
if (! function_exists('hm_get_template_part')) :

    function hm_get_template_part( $file, $template_args = array(), $cache_args = array() ) {
        $template_args = wp_parse_args( $template_args );
        $cache_args = wp_parse_args( $cache_args );
        if ( $cache_args ) {
            foreach ( $template_args as $key => $value ) {
                if ( is_scalar( $value ) || is_array( $value ) ) {
                    $cache_args[$key] = $value;
                } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
                    $cache_args[$key] = call_user_method( 'get_id', $value );
                }
            }
            if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
                if ( ! empty( $template_args['return'] ) )
                    return $cache;
                echo $cache;
                return;
            }
        }
        $file_handle = $file;
        do_action( 'start_operation', 'hm_template_part::' . $file_handle );
        if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
            $file = get_stylesheet_directory() . '/' . $file . '.php';
        elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
            $file = get_template_directory() . '/' . $file . '.php';
        ob_start();
        $return = require( $file );
        $data = ob_get_clean();
        do_action( 'end_operation', 'hm_template_part::' . $file_handle );
        if ( $cache_args ) {
            wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
        }
        if ( ! empty( $template_args['return'] ) )
            if ( $return === false )
                return false;
            else
                return $data;
        echo $data;
    }

endif;

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
     * @return object $category
    */

    function sdc_get_portfolio_category(){
        $category = !empty(get_category_by_slug('portfolio')) ?
            get_category_by_slug('portfolio') :
            get_category_by_slug('portfolio-' . pll_current_language());

        return $category;
    }

endif;

if (! function_exists('sdc_get_contacts_page')) :
    /**
     * get contacts page
     * @return array $post
    */

    function sdc_get_contacts_page() {

        $args = [
            'name'        => 'contacts',
            'post_type'   => 'page',
            'post_status' => 'publish',
            'numberposts' => 1
        ];
        $post = get_posts($args);

        if (!$post) {
            $args = [
                'name'        => 'contacts-' . pll_current_language(),
                'post_type'   => 'page',
                'post_status' => 'publish',
                'numberposts' => 1
            ];

            $post = get_posts($args);
        }

        return $post !== null ? $post[0] : null;
    }

endif;

