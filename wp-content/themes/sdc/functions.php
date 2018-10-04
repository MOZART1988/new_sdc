<?php
/**
 * functions.php for theme SDC
*/

//flush_rewrite_rules( false );

add_action( 'parse_query','changept' );
function changept() {
    if( is_category() && !is_admin() )
        set_query_var( 'post_type', ['post', 'portfolio_item'] );
    return;
}

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
 * Отправка запроса из формы контактов
*/

if (wp_doing_ajax()) {
    add_action('wp_ajax_send_request_contact_form', 'send_request_contact_form_callback');
    add_action('wp_ajax_nopriv_send_request_contact_form', 'send_request_contact_form_callback');
}

add_action( 'wp_footer', 'send_request_contact_form', 99);

function send_request_contact_form() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('submit', '#sendContactForm', function(e){
                //e.preventDefault();
                var form = $(this);
                var data = {
                    action: 'send_request_contact_form',
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
                        form.find('input[type=email]').val('');
                        $('#result-message-ajax').html(data.message);

                    },
                    error: function (data) {
                        console.log(data);
                        $('#result-message-ajax').html('Произошла ошибка сервера');
                    }
                });

                $('#modal--form').modal('show');

                return false;
            });
        });
    </script>
    <?php
}

function send_request_contact_form_callback() {
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['sendContactForm'];
        if (!empty($form['name']) && !empty($form['tel']) && !empty($form['message']) && !empty($form['email'])) {
            $body = '
                <p>Имя - '.$form['name'].'</p>
                <p>Телефон - '.$form['tel'].'</p>
                <p>Email - '.$form['email'].'</p>
                <p>Сообщение - '.$form['message'].'</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - контакт форма', $body)) {
                wp_send_json(
                    ['success' => true, 'message' => pll__('Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время')]
                );
            }

            wp_send_json(
                ['success' => false, 'message' => pll__('Произошла ошибка, попробуйте позже')]
            );
        }
    } else {
        wp_send_json(1);

    }
}

/**
 *  Загрузка элементов событий в отдельной категории
*/

if (wp_doing_ajax()) {
    add_action('wp_ajax_load_items_by_events_category', 'load_items_by_events_category_callback');
    add_action('wp_ajax_nopriv_load_items_by_events_category', 'load_items_by_events_category_callback');
}

add_action( 'wp_footer' , 'load_items_by_events_category', 99);

function load_items_by_events_category() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('click', '.events-filter a', function(){

                $('.events-filter').removeClass('active');
                $(this).parent().addClass('active');

                var data = {
                    action: 'load_items_by_events_category',
                    id: $(this).data('id')
                };
                $.ajax({
                    url: myajax.url,
                    data: data,
                    type: 'GET',
                    dataType: 'html',
                    success: function (data) {
                        console.log(data);
                        $('.events-ajax-result').html(data);
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

function load_items_by_events_category_callback() {

    if (empty($_GET['id'])) {
        wp_die();
    }

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = [
        'post_type'=>'post',
        'posts_per_page' => 10,
        'paged' => $paged,
        'lang' => pll_current_language()
    ];

    if ($_GET['id'] !== 'all') {
        $args = [
            'post_type'=>'post',
            'posts_per_page' => 10,
            'paged' => $paged,
            'lang' => pll_current_language(),
            'cat' => $_GET['id']
        ];
    }


    $loop = new WP_Query( $args );

    if ($loop->have_posts()) {
        echo '<div class="row">';
        while ($loop->have_posts()) {
            $loop->the_post();
            get_template_part('/templates/categories/events/events_item', 'index');
        }
        echo '</div>';

        $total_pages = $loop->max_num_pages;

        if ($total_pages > 1){

            $current_page = max(1, get_query_var('paged'));

            echo '<div class="pagination"><a href="'.get_category_link(sdc_get_events_category()->cat_ID).'" class="back">'.pll__('в самое начало').'</a>' . paginate_links(
                    [
                        'current' => $current_page,
                        'total' => $total_pages,
                        'type' => 'list',
                        'next_text' => '>',
                        'prev_text' => '<',
                        'base' => get_site_url() . '/category/portfolio' . '%_%',
                        'format' => '/page/%#%/',
                        'prev_next' => false,
                    ]
                ) . '<a href="'.get_category_link(sdc_get_events_category()->cat_ID).'page/'.$loop->max_num_pages.'/" class="end">'.pll__('в самый конец').'</a></div>';
        }

        wp_reset_postdata();
    }

    wp_die();
}

/**
 *  Загрузка элементов по портфолио по отдельной категории
*/

if (wp_doing_ajax()) {
    add_action('wp_ajax_load_items_by_portfolio_category', 'load_items_by_portfolio_category_callback');
    add_action('wp_ajax_nopriv_load_items_by_portfolio_category', 'load_items_by_portfolio_category_callback');
}

add_action( 'wp_footer' , 'load_items_by_portfolio_category', 99);

function load_items_by_portfolio_category() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
           $('body').on('click', '.portfolio-filter a', function(){

               $('.portfolio-filter').removeClass('active');
               $(this).parent().addClass('active');

               var container = $('.portfolio-ajax-result');
               var isForSlider = 0;


               if ($('.portfolio-ajax-result-for-slider').length) {
                   container = $('.portfolio-ajax-result-for-slider');
                   isForSlider = 1;
               }

               var data = {
                   action: 'load_items_by_portfolio_category',
                   id: $(this).data('id'),
                   isForSlider: isForSlider
               };

               $.ajax({
                   url: myajax.url,
                   data: data,
                   type: 'GET',
                   dataType: 'html',
                   success: function (data) {
                       container.html(data);
                       $('a.custom-active').parent().addClass('active');

                       if ($('.portfolio-ajax-result-for-slider').length) {
                           $('#portfolio__for--1').slick({
                               autoplay: true,
                               slidesToShow: 1,
                               slidesToScroll: 1,
                               speed: 1500,
                               arrows: true,
                               fade: true,
                               asNavFor: '#portfolio__nav--1'
                           });
                           $('#portfolio__nav--1').slick({
                               autoplay: true,
                               slidesToShow: 13,
                               slidesToScroll: 1,
                               asNavFor: '#portfolio__for--1',
                               arrows: true,
                               centerMode: true,
                               focusOnSelect: true,
                               centerPadding: 0,
                               responsive: [
                                   {
                                       breakpoint: 991,
                                       settings: {
                                           slidesToShow: 3,
                                           arrows: false
                                       }
                                   },
                                   {
                                       breakpoint: 767,
                                       settings: {
                                           slidesToShow: 2,
                                           arrows: true,
                                           centerMode: false,
                                       }
                                   }
                               ]
                           });
                       }
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

    /**
     * Загрузка элементов для слайдера
    */

    if (!empty($_GET['isForSlider'])) {
        global $post;
        hm_get_template_part('templates/categories/portfolio/portfolio_slider', ['clientId' => $post->ID, 'categoryId' => $_GET['id']]);
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
            } elseif ($counter === (int)$counterPost->publish || $counter === 9 || empty($loop->posts[$counter])) {
                echo '</div>';
            }

            $counter++;
        }

        $total_pages = $loop->max_num_pages;

        if ($total_pages > 1){

            $current_page = max(1, get_query_var('paged'));

            echo '<div class="pagination"><a href="'.get_category_link(sdc_get_portfolio_category()->cat_ID).'" class="back">'.pll__('в самое начало').'</a>' . paginate_links(
                    [
                        'current' => $current_page,
                        'total' => $total_pages,
                        'type' => 'list',
                        'next_text' => '>',
                        'prev_text' => '<',
                        'base' => get_site_url() . '/category/portfolio' . '%_%',
                        'format' => '/page/%#%/',
                        'prev_next' => false,
                    ]
                ) . '<a href="'.get_category_link(sdc_get_portfolio_category()->cat_ID).'page/'.$loop->max_num_pages.'/" class="end">'.pll__('в самый конец').'</a></div>';
        }
    }

    wp_reset_postdata();

    wp_die();
}

/**
 * Отправка формы обратный звонок
*/

if (wp_doing_ajax()) {
    add_action('wp_ajax_send_request_phone_form', 'send_request_phone_form_callback');
    add_action('wp_ajax_nopriv_send_request_phone_form', 'send_request_phone_form_callback');
}

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
                    ['success' => true, 'message' => pll__('Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время')]
                );
            }

            wp_send_json(
                ['success' => false, 'message' => pll__('Произошла ошибка, попробуйте позже')]
            );
        }
    } else {
        wp_send_json(1);

    }
}

/**
 * Элемент клиет в админке
 * @return WP_Post_Type
*/

function client_item() {
    register_post_type( 'client_item', [
        'labels' => [
            'name'            => __( 'Клиенты' ),
            'singular_name'   => __( 'Клиент' ),
            'add_new'         => __( 'Добавить' ),
            'add_new_item'    => __( 'Добавить нового клиента' ),
            'edit'            => __( 'Редактировать' ),
            'edit_item'       => __( 'Редактировать клиента' ),
            'new_item'        => __( 'Новый клиент' ),
            'all_items'       => __( 'Клиенты' ),
            'view'            => __( 'Просмотреть' ),
            'view_item'       => __( 'Просмотреть клиента' ),
            'search_items'    => __( 'Поиск' ),
            'not_found'       => __( 'Не удалось найти' ),
        ],
        'public' => true,
        'menu_position' => 7,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'has_archive' => false,
        'capability_type' => 'post',
        'taxonomies' => ['category'],
        'menu_icon'   => 'dashicons-images-alt',
    ]);
}

add_action( 'init', 'client_item' );

/**
 * Элемент основные направления в админке
 * @return WP_Post_Type
*/

function direction_item() {
    register_post_type('direction_item', [
        'labels' => [
            'name'            => __( 'Основные направления' ),
            'singular_name'   => __( 'Основные направления' ),
            'add_new'         => __( 'Добавить' ),
            'add_new_item'    => __( 'Добавить новый элемент' ),
            'edit'            => __( 'Редактировать' ),
            'edit_item'       => __( 'Редактировать элемент' ),
            'new_item'        => __( 'Новый элемент' ),
            'all_items'       => __( 'Основные направления' ),
            'view'            => __( 'Просмотреть' ),
            'view_item'       => __( 'Просмотреть элемент' ),
            'search_items'    => __( 'Поиск' ),
            'not_found'       => __( 'Не удалось найти' ),
        ],
        'public' => true,
        'menu_position' => 6,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'],
        'taxonomies' => ['category'],
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-images-alt',
        'rewrite' => ['slug' => 'direction'],
    ]);
}

add_action( 'init', 'direction_item' );

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
        //'rewrite' => ['slug' => 'portfolio'],
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
 * Поле клиента в добавлении элемента портфолио
*/
function portfolio_client_id() {
    add_meta_box(
        'pt_client_id',
        __('Клиент'),
        'portfolio_client_id_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_client_id');

function portfolio_client_id_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_client_id');
    $links_stored_meta = get_post_meta( $post->ID );
    $args = ['post_type' => 'client_item', 'posts_per_page' => -1, 'post_status' => 'any', 'post_parent' => null];
    $clients = get_posts($args);
    ?>
    <select name="pt_client_id_original" id="pt_client_id_original">
        <?php foreach ($clients as $client) : ?>
            <option value="<?=$client->ID?>"
                <?=(isset($links_stored_meta['pt_client_id_original']) && ($links_stored_meta['pt_client_id_original'][0] == $client->ID)
                    ? 'selected' : '')?>>
                <?=$client->post_title?>
            </option>
        <?php endforeach ; ?>
    </select>

    <?php
}

/**
 * Cохранение клиента в элементе портфолио
 */

function portfolio_client_id_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pt_client_id' ] )
        && wp_verify_nonce( $_POST[ 'pt_client_id' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pt_client_id_original' ] ) ) {
        update_post_meta( $post_id, 'pt_client_id_original', sanitize_text_field( $_POST[ 'pt_client_id_original' ] ) );
    }
}

add_action('save_post', 'portfolio_client_id_save');

/**
 * Задача для элемента портфолио
*/

function portfolio_goal() {
    add_meta_box(
        'pt_goal',
        __('Задача'),
        'portfolio_goal_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_goal');


function portfolio_goal_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_goal');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <input required type="text" size="100"
           name="pt_goal_original"
           id="pt_goal_original"
           value="<?php if ( isset ( $links_stored_meta['pt_goal_original'] ) ) echo $links_stored_meta['pt_goal_original'][0]; ?>"/>
    <?php
}

/**
 * Cохранение
 */

function portfolio_goal_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pt_goal' ] ) && wp_verify_nonce( $_POST[ 'pt_goal' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pt_goal_original' ] ) ) {
        update_post_meta( $post_id, 'pt_goal_original', sanitize_text_field( $_POST[ 'pt_goal_original' ] ) );
    }
}

add_action('save_post', 'portfolio_goal_save');

/**
 * Поле решение в портфолио
*/
function portfolio_desicion() {
    add_meta_box(
        'pt_desicion',
        __('Решение'),
        'portfolio_desicion_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_desicion');


function portfolio_desicion_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_desicion');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>

    <input required type="text" size="100"
           name="pt_desicion_original"
           id="pt_desicion_original"
           value="<?php if ( isset ( $links_stored_meta['pt_desicion_original'] ) ) echo $links_stored_meta['pt_desicion_original'][0]; ?>"/>
    <?php
}

/**
 * Cохранение
 */

function portfolio_desicion_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pt_desicion' ] ) && wp_verify_nonce( $_POST[ 'pt_desicion' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pt_desicion_original' ] ) ) {
        update_post_meta( $post_id, 'pt_desicion_original', sanitize_text_field( $_POST[ 'pt_desicion_original' ] ) );
    }
}

add_action('save_post', 'portfolio_desicion_save');

/**
 * Поле большой картинки в портфолио
 */
function portfolio_custom_image_one() {
    add_meta_box(
        'pt_custom_image_one',
        __('Дополнительное изображение 1'),
        'portfolio_custom_image_one_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_custom_image_one');

function portfolio_custom_image_one_callback($post) {

    $attachmentId = get_post_meta($post->ID, 'pt_custom_image_one'); ?>

    <input id="pt_custom_image_one_original" name="pt_custom_image_one_original" type="hidden" value="<?=$attachmentId[0];?>"  />

    <p>
        <a href="#" id="portfolio_custom_image_one_upload">Загрузите изображение для портфолио</a>
    </p>

    <br/>

    <img src="<?= !empty($attachmentId[0]) ? wp_get_attachment_image_src($attachmentId[0], 'portfolio')[0] : ''?>"
         style="width:200px;" id="picsrc" />
    <script>
        $(document).ready( function($) {
            $('#portfolio_custom_image_one_upload').click(function() {

                metaImageFrame = wp.media.frames.metaImageFrame = wp.media({
                    title: 'Изображения портфолио',
                    button: { text:  'Загрузите изображение для портфолио' },
                });

                metaImageFrame.on('select', function() {

                    var media_attachment = metaImageFrame.state().get('selection').first().toJSON();

                    console.log(media_attachment);

                    $( '#picsrc' ).attr('src', media_attachment.link);

                    $('#pt_custom_image_one_original').val(media_attachment.id);

                });

                metaImageFrame.open();

            });
        });
    </script>
    <?php
}

/**
 * Сохранение
*/

function portfolio_custom_image_one_save($post_id) {
    if (isset($_POST['pt_custom_image_one_original'])){
        update_post_meta($post_id, 'pt_custom_image_one', $_POST['pt_custom_image_one_original']);
    }
}

add_action('save_post', 'portfolio_custom_image_one_save');

/**
 * Короткое описание для поста
*/

function post_short_text() {
    add_meta_box(
        'pst_short_text',
        __('Короткое описание'),
        'post_short_text_callback',
        'post'
    );
}

add_action('add_meta_boxes', 'post_short_text');


function post_short_text_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pst_short_text');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <textarea style="width:100%"
           name="pst_short_text_original"
           id="pst_short_text_original"
           value="<?php if ( isset ( $links_stored_meta['pst_short_text_original'] ) ) echo $links_stored_meta['pst_short_text_original'][0]; ?>" >
        <?php if ( isset ( $links_stored_meta['pst_short_text_original'] ) ) echo $links_stored_meta['pst_short_text_original'][0]; ?>"
    </textarea>
    <?php
}

/**
 * Cохранение
 */

function post_short_text_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pst_short_text' ] ) && wp_verify_nonce( $_POST[ 'pst_short_text' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pst_short_text_original' ] ) ) {
        update_post_meta( $post_id, 'pst_short_text_original', sanitize_text_field( $_POST[ 'pst_short_text_original' ] ) );
    }
}

add_action('save_post', 'post_short_text_save');



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

/**
 * set email format to html
*/

add_filter( 'wp_mail_content_type', 'wpse27856_set_content_type' );

function wpse27856_set_content_type(){

    return "text/html";

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
        add_theme_support( 'title-tag' );


        add_image_size( 'portfolio', 398, 326, true );
        add_image_size('portfolio-slide', 710, 572, true);
        add_image_size('portfolio-slide-small', 94, 80, true);


        add_image_size('direction', 135, 126, true);

        add_image_size('events', 281, 186, true);
        add_image_size('event-single', 298, 216, true);

        add_image_size('client-thumb', 162, 162);
        add_image_size('client-list', 324, 262, true);
        add_image_size('client-others', 333, 273, true);

        /**
         * removes autop from single content
         */

        remove_filter( 'the_content', 'wpautop' );


        /**
         * register strings for polylang
        */

        /**
         * header.php
        */
        pll_register_string('Агентство рекламы и маркетинга', 'Агентство рекламы и маркетинга', 'SDC');
        pll_register_string('Перезвонить?', 'Перезвонить?', 'SDC');

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
        pll_register_string('Smartdigital', 'Smartdigital', 'SDC');

        /**
         * contacts-main.php
        */
        pll_register_string('Электронная почта', 'Электронная почта', 'SDC');
        pll_register_string('Контактный номер телефона', 'Контактный номер телефона', 'SDC');
        pll_register_string('Ваше письмо отправленно', 'Ваше письмо отправленно', 'SDC');
        pll_register_string('Обратная связь:', 'Обратная связь:', 'SDC');
        pll_register_string('Произошла ошибка, попробуйте позже', 'Произошла ошибка, попробуйте позже', 'SDC');
        pll_register_string('Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время', 'Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время', 'SDC');

        /**
         * request-phone.php
        */
        pll_register_string('Имя', 'Имя', 'SDC');
        pll_register_string('Контактный номер', 'Контактный номер', 'SDC');
        pll_register_string('Сообщение', 'Сообщение', 'SDC');
        pll_register_string('Отправить', 'Отправить', 'SDC');
        pll_register_string('Закажите услугу', 'Закажите услугу', 'SDC');
        pll_register_string('или получите консультацию', 'или получите консультацию', 'SDC');

        /**
         * common strings
        */

        pll_register_string('в самый конец', 'в самый конец', 'SDC');
        pll_register_string('в самое начало', 'в самое начало', 'SDC');
        pll_register_string('Задача:', 'Задача:', 'SDC');
        pll_register_string('Просмотреть результат', 'Просмотреть результат', 'SDC');

        /**
         * single post
        */

        pll_register_string('Метки:', 'Метки:', 'SDC');


        /**
         * single client_item
        */

        pll_register_string('Все работы для компании', 'Все работы для компании', 'SDC');

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

        if (is_single()) {
            return 'body--porfolio second';
        }

        return 'body';
    }

endif;

if (! function_exists('sdc_get_events_category')) :
    /**
     * get events category
     * @return object
     */

    function sdc_get_events_category(){

        return !empty(get_category_by_slug('events')) ?
            get_category_by_slug('events') :
            get_category_by_slug('events-' . pll_current_language());
    }

    /**
     * get events category from request
     * @return object
     */
    function sdc_get_events_category_from_request(){
        $term = get_queried_object();

        if ($term !== null) {
            $term_slug = get_queried_object()->slug;

            if ($term_slug === 'events' || (strpos($term_slug, 'events') !== false)) {
                return sdc_get_events_category();
            }
        }

        return null;
    }
endif;

if (! function_exists('sdc_get_portfolio_category')) :
    /**
     * get portfolio category
     * @return object
    */

    function sdc_get_portfolio_category(){

        return !empty(get_category_by_slug('portfolio')) ?
            get_category_by_slug('portfolio') :
            get_category_by_slug('portfolio-' . pll_current_language());
    }

    /**
     * get portfolio category from request
     * @return object
     */
    function sdc_get_portfolio_category_from_request(){
        $term = get_queried_object();

        if ($term !== null) {
            $term_slug = get_queried_object()->slug;

            if ($term_slug === 'portfolio' || (strpos($term_slug, 'portfolio') !== false)) {
                return sdc_get_portfolio_category();
            }
        }

        return null;
    }

endif;

if (! function_exists('sdc_get_direction_category')) {
    /**
     * get direction category
     * @return object
    */

    function sdc_get_direction_category() {

        return !empty(get_category_by_slug('direction')) ?
            get_category_by_slug('direction') :
            get_category_by_slug('direction-' . pll_current_language());

    }

    /**
     * get direction category from request
     * @return object
     */
    function sdc_get_direction_category_from_request() {

        $term = get_queried_object();

        if ($term !== null) {
            $term_slug = get_queried_object()->slug;

            if ($term_slug === 'direction' || (strpos($term_slug, 'direction') !== false)) {
                return sdc_get_direction_category();
            }
        }

        return null;
    }
}

if (! function_exists('sdc_get_clients_category')) :
    /**
     * get clients category
     * @return object
     */

    function sdc_get_clients_category() {

        return !empty(get_category_by_slug('clients')) ?
            get_category_by_slug('clients') :
            get_category_by_slug('clients-' . pll_current_language());

    }

    /**
     * get clients category from request
     * @return object
     */
    function sdc_get_clients_category_from_request() {

        $term = get_queried_object();

        if ($term !== null) {
            $term_slug = get_queried_object()->slug;

            if ($term_slug === 'clients' || (strpos($term_slug, 'clients') !== false)) {
                return sdc_get_clients_category();
            }
        }

        return null;
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

