<?php
/**
 * functions.php for theme SDC
*/

/**
 * TODO hide from here wp_editor throght action
*/


/**
 * Add custom javascript file to admin
*/

function admin_custom_scripts($hook) {
    wp_enqueue_style('imageSelectStyleChosen', get_template_directory_uri() . '/css/admin/chosen.min.css');
    wp_enqueue_style('imageSelectStyle', get_template_directory_uri() . '/css/admin/imageselect.css');

    wp_enqueue_script('imageSelectChosen', get_template_directory_uri() . '/js/admin/chosen.jquery.js');
    wp_enqueue_script('imageSelectJs', get_template_directory_uri() . '/js/admin/imageselect.jquery.js');
    wp_enqueue_script('admin', get_template_directory_uri() . '/js/admin/admin.js');
}

add_action('admin_enqueue_scripts', 'admin_custom_scripts');

/**
 * SMM Landing
*/

/**
 * Отправка формы из лендинга SMM в футере
 */

if (wp_doing_ajax()) {
    add_action('wp_ajax_send_request_footer_smm_form', 'send_request_footer_smm_form_callback');
    add_action('wp_ajax_nopriv_send_request_footer_smm_form', 'send_request_footer_smm_form_callback');
}

add_action( 'wp_footer' , 'send_request_footer_smm_form', 99);

function send_request_footer_smm_form() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('submit', '#formFooterSmm', function(e){

                e.preventDefault();
                var form = $(this);
                var data = {
                    action: 'send_request_footer_smm_form',
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
                        $('#modal--form').find('.modal-content').find('.modal-body').find('h4').html(data.message);
                        $('#modal--form').modal('show');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

                return false;
            });
        });
    </script>
    <?php
}

function send_request_footer_smm_form_callback() {
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['formFooterSmm'];
        if (!empty($form['name']) && !empty($form['phone']) && !empty($form['email']) && !empty($form['message'])) {
            $body = '
                <p>Имя - '.$form['name'].'</p>
                <p>Телефон - '.$form['phone'].'</p>
                <p>Email - '.$form['email'].'</p>
                <p>Сообщение - '.$form['message'].'</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - "Расскажите о своем проекте (форма с Лендинга СММ)"', $body)) {
                wp_send_json(
                    ['success' => true, 'message' => pll__('Ваше письмо отправленно')]
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
 * Отправка формы Закажите индивидуальный просчет вашего проекта
 */

if (wp_doing_ajax()) {
    add_action('wp_ajax_send_request_smm_form', 'send_request_smm_form_callback');
    add_action('wp_ajax_nopriv_send_request_smm_form', 'send_request_smm_form_callback');
}

add_action( 'wp_footer' , 'send_request_smm_form', 99);

function send_request_smm_form() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('submit', '#smmForm', function(e){

                e.preventDefault();
                var form = $(this);
                var data = {
                    action: 'send_request_smm_form',
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
                        $('#modal--form').find('.modal-content').find('.modal-body').find('h4').html(data.message);
                        $('#modal--form').modal('show');
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });

                return false;
            });
        });
    </script>
    <?php
}

function send_request_smm_form_callback() {
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['smmForm'];
        if (!empty($form['name']) && !empty($form['phone']) && !empty($form['email'])) {
            $body = '
                <p>Имя - '.$form['name'].'</p>
                <p>Телефон - '.$form['phone'].'</p>
                <p>Email - '.$form['email'].'</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - "Закажите индивидуальный просчет вашего проекта"', $body)) {
                wp_send_json(
                    ['success' => true, 'message' => pll__('Ваше письмо отправленно')]
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
 * Секция Видео слайдера
*/

add_action( 'add_meta_boxes', 'add_video_section' );

add_action( 'save_post', 'video_save' );

function add_video_section() {
    add_meta_box(
        'video-section',
        'Секция видеослайдера',
        'video_section_init',
        'page');
}

function video_section_init() {
    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'video_nonce' );
    ?>
    <div id="team-section-item">
    <?php

    $videoSectionDetails = get_post_meta($post->ID,'videoSectionDetails',true);
    $c = 0;

    if (is_array($videoSectionDetails) && count( $videoSectionDetails ) > 0 ) {
        foreach( $videoSectionDetails as $item ) {
            if ( isset( $item['video'] ) ) {
                printf( '<p>
                    Видео : 
                        <input type="text" name="videoSectionDetails[%1$s][video]" value="%2$s" required/>
                        <a href="#video-section-item-remove" class="remove-package-video button">%3$s</a>
                    </p>', $c, $item['video'], 'Удалить'
                );
                $c++;
            }
        }
    }

    ?>
    <span id="output-package-video"></span>
    <a href="#" class="button add_package_video button-primary"><?php _e('Добавить элемент'); ?></a>
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;

            $(".add_package_video").click(function() {
                count = count + 1;

                var html = '<p>' +
                    '                        Видео :' +
                    '                        <input type="text" name="videoSectionDetails['+count+'][video]" required/>' +
                    '                        <a href="#video-section-item-remove" class="remove-package-video button">Удалить</a>' +
                    '                    </p>';

                $('#output-package-video')
                    .append( html );
                return false;
            });
            $(document.body).on('click','.remove-package-video', function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div><?php

}

function video_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['video_nonce'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['video_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    $videoSectionDetails = $_POST['videoSectionDetails'];

    update_post_meta($post_id,'videoSectionDetails',$videoSectionDetails);
}

/**
 * Секция "Кто будет работать над вашим проектом"
*/

add_action( 'add_meta_boxes', 'add_team_section' );

add_action( 'save_post', 'team_section_save' );

function add_team_section() {
    add_meta_box(
        'team-section',
        'Секция Кто будет работать над вашим проектом',
        'team_section_init',
        'page');
}

function team_section_init() {
    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'team_nonce' );
    ?>
    <div id="team-section-item">
    <?php

    $teamSectionDetails = get_post_meta($post->ID,'teamSectionDetails',true);
    $c = 0;

    if (is_array($teamSectionDetails) && count( $teamSectionDetails ) > 0 ) {
        foreach( $teamSectionDetails as $item ) {
            if ( isset( $item['member'] ) || isset( $item['text'] ) ) {
                printf( '<p>
                    Команда :
                        <select name="teamSectionDetails[%1$s][member]">
                            <option  value="1" '.((int)$item['member'] === 1 ? 'selected' : '').'>Project Менеджер</option>
                            <option  value="2" '.((int)$item['member'] === 2 ? 'selected' : '').'>Стратег</option>
                            <option  value="3" '.((int)$item['member'] === 3 ? 'selected' : '').'>Контент Менеджер</option>
                            <option  value="4" '.((int)$item['member'] === 4 ? 'selected' : '').'>Дизайнер</option>
                            <option  value="5" '.((int)$item['member'] === 5 ? 'selected' : '').'>Модератор</option>
                            <option  value="6" '.((int)$item['member'] === 6 ? 'selected' : '').'>Таргетолог</option>
                            <option  value="7" '.((int)$item['member'] === 7 ? 'selected' : '').'>Аналитик</option>
                        </select> 
                    Текст : 
                        <textarea name="teamSectionDetails[%1$s][text]" required>%3$s</textarea>
                        <a href="#team-section-item-remove" class="remove-package-team button">%4$s</a>
                    </p>', $c, $item['member'], $item['text'], 'Удалить'
                );
                $c++;
            }
        }
    }

    ?>
    <span id="output-package-team"></span>
    <a href="#" class="button add_package_team button-primary"><?php _e('Добавить элемент'); ?></a>
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;

            $(".add_package_team").click(function() {
                count = count + 1;

                var html = '<p>' +
                    '                    Команда :' +
                    '                        <select name="teamSectionDetails['+count+'][member]">' +
                    '                            <option  value="1">Project Менеджер</option>' +
                    '                            <option  value="2">Стратег</option>' +
                    '                            <option  value="3">Контент Менеджер</option>' +
                    '                            <option  value="4">Дизайнер</option>' +
                    '                            <option  value="5">Модератор</option>' +
                    '                            <option  value="6">Таргетолог</option>' +
                    '                            <option  value="7">Аналитик</option>' +
                    '                        </select>' +
                    '                        Текст :' +
                    '                        <textarea name="teamSectionDetails['+count+'][text]" required></textarea>' +
                    '                        <a href="#team-section-item-remove" class="remove-package-team button">Удалить</a>' +
                    '                    </p>';

                $('#output-package-team')
                    .append( html );
                return false;
            });
            $(document.body).on('click','.remove-package-team', function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div><?php

}

function team_section_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['team_nonce'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['team_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    $teamSectionDetails = $_POST['teamSectionDetails'];

    update_post_meta($post_id,'teamSectionDetails',$teamSectionDetails);
}

/**
 * Секция Что мы сделаем для вас
 */
add_action( 'add_meta_boxes', 'add_doinglist_section' );

add_action( 'save_post', 'doinglist_save' );


function add_doinglist_section() {
    add_meta_box(
        'doing-section',
        'Секция Что мы сделаем для Вас',
        'doinglist_section_init',
        'page');
}

function doinglist_section_init() {
    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'doinglist_nonce' );
    ?>
    <div id="doinglist-section-item">
    <?php

    $doinglistSectionDetails = get_post_meta($post->ID,'doinglistSectionDetails',true);
    $c = 0;

    if (is_array($doinglistSectionDetails) && count( $doinglistSectionDetails ) > 0 ) {
        foreach( $doinglistSectionDetails as $item ) {
            if ( isset( $item['icon'] ) || isset( $item['text'] ) ) {
                printf( '<p>
                    Иконка :
                        <select class="imageSelect" name="doinglistSectionDetails[%1$s][icon]">
                            <option data-img-src="/img/img-63.png" value="1" '.((int)$item['icon'] === 1 ? 'selected' : '').'>Иконка 1</option>
                            <option data-img-src="/img/img-64.png" value="2" '.((int)$item['icon'] === 2 ? 'selected' : '').'>Иконка 2</option>
                            <option data-img-src="/img/img-65.png" value="3" '.((int)$item['icon'] === 3 ? 'selected' : '').'>Иконка 3</option>
                            <option data-img-src="/img/img-66.png" value="4" '.((int)$item['icon'] === 4 ? 'selected' : '').'>Иконка 4</option>
                            <option data-img-src="/img/img-67.png" value="5" '.((int)$item['icon'] === 5 ? 'selected' : '').'>Иконка 5</option>
                            <option data-img-src="/img/img-68.png" value="6" '.((int)$item['icon'] === 6 ? 'selected' : '').'>Иконка 6</option>
                            <option data-img-src="/img/img-69.png" value="7" '.((int)$item['icon'] === 7 ? 'selected' : '').'>Иконка 7</option>
                            <option data-img-src="/img/img-70.png" value="8" '.((int)$item['icon'] === 8 ? 'selected' : '').'>Иконка 8</option>
                        </select> 
                    Текст : 
                        <input type="text" name="doinglistSectionDetails[%1$s][text]"  value="%3$s" required/>
                        <a href="#doinglist-section-item-remove" class="remove-package-doinglist button">%4$s</a>
                    </p>', $c, $item['icon'], $item['text'], 'Удалить'
                    );
                $c++;
            }
        }
    }

    ?>
    <span id="output-package-doinglist"></span>
    <a href="#" class="button add_package_doinglist button-primary"><?php _e('Добавить элемент'); ?></a>
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;

            $(".add_package_doinglist").click(function() {
                count = count + 1;

                var html = '<p>' +
                    '                    Иконка :' +
                    '                        <select class="imageSelect" name="doinglistSectionDetails['+count+'][icon]">' +
                    '                            <option data-img-src="/img/img-63.png" value="1">Иконка 1</option>' +
                    '                            <option data-img-src="/img/img-64.png" value="2">Иконка 2</option>' +
                    '                            <option data-img-src="/img/img-65.png" value="3">Иконка 3</option>' +
                    '                            <option data-img-src="/img/img-66.png" value="4">Иконка 4</option>' +
                    '                            <option data-img-src="/img/img-67.png" value="5">Иконка 5</option>' +
                    '                            <option data-img-src="/img/img-68.png" value="6">Иконка 6</option>' +
                    '                            <option data-img-src="/img/img-69.png" value="7">Иконка 7</option>' +
                    '                            <option data-img-src="/img/img-70.png" value="8">Иконка 8</option>' +
                    '                        </select>' +
                    '                        Текст :' +
                    '                        <input type="text" name="doinglistSectionDetails['+count+'][text]"  value="" required/>' +
                    '                        <a href="#doinglist-section-item-remove" class="remove-package-doinglist button">Удалить</a>' +
                    '                    </p>';

                $('#output-package-doinglist')
                    .append( html );

                $('.imageSelect').chosen({ width:"40%"});

                return false;
            });
            $(document.body).on('click','.remove-package-doinglist', function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div><?php

}

function doinglist_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['doinglist_nonce'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['doinglist_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    $doinglistSectionDetails = $_POST['doinglistSectionDetails'];

    update_post_meta($post_id,'doinglistSectionDetails', $doinglistSectionDetails);
}

/**
 * Секция СММ
*/
add_action( 'add_meta_boxes', 'add_smm_section_name' );

add_action( 'save_post', 'smm_section_save' );


function add_smm_section_name() {
    add_meta_box(
        'smm-section',
        'Секция СММ',
        'smm_section_init',
        'page');
}

function smm_section_init() {
    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'smm_nonce' );
    ?>
    <div id="smm-section-item">
    <?php

    $smmSectionDetails = get_post_meta($post->ID,'smmSectionDetails',true);
    $c = 0;
    if (is_array($smmSectionDetails) && count( $smmSectionDetails ) > 0 ) {
        foreach( $smmSectionDetails as $item ) {
            if ( isset( $item['number'] ) || isset( $item['text'] ) ) {
                printf( '<p>Цифра
                    <input type="text" name="smmSectionDetails[%1$s][number]" value="%2$s" />  
                    Текст : <input type="text" name="smmSectionDetails[%1$s][text]"  value="%3$s"/>
                    <a href="#remove-smm-section-item" class="remove-package button">%4$s</a></p>', $c, $item['number'], $item['text'], 'Удалить' );
                $c++;
            }
        }
    }

    ?>
    <span id="output-package"></span>
    <a href="#" class="button add_package button-primary"><?php _e('Добавить элемент'); ?></a>
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
            $(".add_package").click(function() {
                count = count + 1;

                $('#output-package').append('<p> Цифра <input type="text" name="smmSectionDetails['+count+'][number]" value="" />  Текст : <input type="text" name="smmSectionDetails['+count+'][text]"  value=""/><a href="#remove-smm-section-item" class="button remove-package">Удалить</a></p>' );
                return false;
            });
            $(document.body).on('click','.remove-package',function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div><?php

}

function smm_section_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['smm_nonce'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['smm_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    $smmSectionDetails = $_POST['smmSectionDetails'];

    update_post_meta($post_id,'smmSectionDetails',$smmSectionDetails);
}

/**
 * Секция Преимущества
 */
add_action( 'add_meta_boxes', 'add_advantages_section' );

add_action( 'save_post', 'advantages_section_save' );


function add_advantages_section() {
    add_meta_box(
        'advantages-section',
        'Секция Преимущества',
        'advantages_section_init',
        'page');
}

function advantages_section_init() {
    global $post;

    wp_nonce_field( plugin_basename( __FILE__ ), 'advantages_nonce' );
    ?>
    <div id="advantages-section-item">
    <?php

    $advantagesSectionDetails = get_post_meta($post->ID,'advantagesSectionDetails',true);
    $c = 0;
    if (is_array($advantagesSectionDetails) && count( $advantagesSectionDetails ) > 0 ) {
        foreach( $advantagesSectionDetails as $item ) {
            if ( isset( $item['title'] ) || isset( $item['text'] ) ) {
                printf( '<p>Заголовок :
                    <input type="text" name="advantagesSectionDetails[%1$s][title]" value="%2$s" />  
                    Текст : <textarea name="advantagesSectionDetails[%1$s][text]">%3$s</textarea>
                    <a href="#remove-advantages-section-item" class="remove-package-advantages button">%4$s</a></p>', $c, $item['title'], $item['text'], 'Удалить' );
                $c++;
            }
        }
    }

    ?>
    <span id="output-package-advantages"></span>
    <a href="#" class="button add_advantage button-primary"><?php _e('Добавить элемент'); ?></a>
    <script>
        var $ = jQuery.noConflict();
        $(document).ready(function() {
            var count = <?php echo $c; ?>;
            $(".add_advantage").click(function() {
                count = count + 1;

                $('#output-package-advantages').append('<p> Заголовок : <input type="text" name="advantagesSectionDetails['+count+'][title]" value="" />  Текст : <textarea name="advantagesSectionDetails['+count+'][text]"></textarea><a href="#remove-advantiges-section-item" class="button remove-package">Удалить</a></p>' );
                return false;
            });
            $(document.body).on('click','.remove-package-advantages',function() {
                $(this).parent().remove();
            });
        });
    </script>
    </div><?php

}

function advantages_section_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['advantages_nonce'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['advantages_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    $smmSectionDetails = $_POST['advantagesSectionDetails'];

    update_post_meta($post_id,'advantagesSectionDetails',$smmSectionDetails);
}



/**
 * Табы на главной
*/

const TAB_1 = 'Почему мы';
const TAB_2 = 'Как мы работаем';
const TAB_3 = 'Миссия компании';

$tabArray = [
    1 => TAB_1,
    2 => TAB_2,
    3 => TAB_3,
];

/**
 * Иконки в разделе "Что мы сделаем для вас" в лендинге СММ
*/

const ICON_1 = 1;
const ICON_2 = 2;
const ICON_3 = 3;
const ICON_4 = 4;
const ICON_5 = 5;
const ICON_6 = 6;
const ICON_7 = 7;
const ICON_8 = 8;

$iconsArray = [
    ICON_1 => '<img src="/img/img-63.png" alt="">',
    ICON_2 => '<img src="/img/img-64.png" alt="">',
    ICON_3 => '<img src="/img/img-65.png" alt="">',
    ICON_4 => '<img src="/img/img-66.png" alt="">',
    ICON_5 => '<img src="/img/img-67.png" alt="">',
    ICON_6 => '<img src="/img/img-68.png" alt="">',
    ICON_7 => '<img src="/img/img-69.png" alt="">',
    ICON_8 => '<img src="/img/img-70.png" alt="">'
];

/**
 * Иконки в разделе "Кто будет работать над Вашим проектом"
*/

const MEMBER_1 = 1;
const MEMBER_2 = 2;
const MEMBER_3 = 3;
const MEMBER_4 = 4;
const MEMBER_5 = 5;
const MEMBER_6 = 6;
const MEMBER_7 = 7;

$membersArray = [
    MEMBER_1 => '<img src="/img/img-73.png" alt="">',
    MEMBER_2 => '<img src="/img/img-74.png" alt="">',
    MEMBER_3 => '<img src="/img/img-75.png" alt="">',
    MEMBER_4 => '<img src="/img/img-76.png" alt="">',
    MEMBER_5 => '<img src="/img/img-77.png" alt="">',
    MEMBER_6 => '<img src="/img/img-78.png" alt="">',
    MEMBER_7 => '<img src="/img/img-79.png" alt="">'
];

$membersTitlesArray = [
    MEMBER_1 => pll__('Project менеджер'),
    MEMBER_2 => pll__('Стратег'),
    MEMBER_3 => pll__('Контент менеджер'),
    MEMBER_4 => pll__('Дизайнер'),
    MEMBER_5 => pll__('Модератор'),
    MEMBER_6 => pll__('Таргетолог'),
    MEMBER_7 => pll__('Аналитик'),
];


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
 * Отправка запроса заказать проект
*/

if (wp_doing_ajax()) {
    add_action('wp_ajax_send_request_project', 'send_request_project_callback');
    add_action('wp_ajax_nopriv_send_request_project', 'send_request_project_callback');
}

add_action( 'wp_footer', 'send_request_project', 99);

function send_request_project() {
    ?>
    <script type="text/javascript" >
        $(document).ready(function($) {
            $('body').on('submit', '#sendProjectForm', function(e){
                //e.preventDefault();
                var form = $(this);
                var data = {
                    action: 'send_request_project',
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
                        $('.send-project-result').html(data.message);

                    },
                    error: function (data) {
                        console.log(data);
                        $('.send-project-result').html('Произошла ошибка сервера');
                    }
                });

                $('#modal--portfolio').modal('show');

                return false;
            });
        });
    </script>
    <?php
}

function send_request_project_callback() {
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['sendProjectForm'];
        if (!empty($form['name']) && !empty($form['tel']) && !empty($form['message']) && !empty($form['email']) && !empty($form['company'])) {
            $body = '
                <p>Имя - '.$form['name'].'</p>
                <p>Телефон - '.$form['tel'].'</p>
                <p>Email - '.$form['email'].'</p>
                <p>Компания - '.$form['company'].'</p>
                <p>Сообщение - '.$form['message'].'</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - Заказать проект', $body)) {
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
                   isForSlider: isForSlider,
                   postId: $('.portfolio__nav').data('post-id')
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

    if (!empty($_GET['isForSlider']) && (int)$_GET['isForSlider'] === 1 && !empty($_GET['postId'])) {

        $postType = get_post_type($_GET['postId']);

        if ($postType === 'portfolio_item') {

            if (!empty(get_post_meta($_GET['postId'], 'pt_client_id_original'))) {

                $clientId = get_post_meta($_GET['postId'], 'pt_client_id_original')[0];

                echo hm_get_template_part('templates/categories/portfolio/portfolio_slider', [
                    'clientId' => $clientId,
                    'categoryId' => $_GET['id'],
                    'post__not_in' => [$_GET['postId']],
                ]);
                wp_die();

            }


        }

        echo hm_get_template_part('templates/categories/portfolio/portfolio_slider', [
            'clientId' => $_GET['postId'],
            'categoryId' => $_GET['id']
        ]);
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

function send_request_phone_form_callback()
{
    if (!empty($_POST['form'])) {
        parse_str(urldecode($_POST['form']), $result);
        $form = $result['requestPhoneForm'];
        if (!empty($form['name']) && !empty($form['tel']) && !empty($form['message'])) {
            $body = '
                <p>Имя - ' . $form['name'] . '</p>
                <p>Телефон - ' . $form['tel'] . '</p>
                <p>Сообщение - ' . $form['message'] . '</p>
            ';

            $to = get_option('admin_email');


            if (wp_mail($to, 'Новый запрос - перезвоните мне', $body)) {
                wp_send_json(
                    [
                        'success' => true,
                        'message' => pll__('Спасибо за Ваше обращение, мы свяжемся с Вами в ближайшее время')
                    ]
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
        'menu_icon'   => 'dashicons-admin-users',
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
        'supports' => ['title', 'thumbnail'],
        'taxonomies' => ['category'],
        'has_archive' => true,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-admin-multisite',
        'rewrite' => ['slug' => 'direction'],
    ]);
}

add_action( 'init', 'direction_item' );

/**
 * Удалить сео блок из элемента направления
*/

function direction_item_remove_seo() {
    remove_meta_box('wpseo_meta', 'direction_item', 'normal');
}
add_action('add_meta_boxes', 'direction_item_remove_seo', 100);



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
        'menu_icon'   => 'dashicons-portfolio',
    ]);
}
add_action( 'init', 'portfolio_item' );

/**
 * Элемент из таба на главной странице
*/

function mainpage_tab_item() {
    register_post_type('mainpage_tab_item', [
        'labels' => [
            'name'            => __( 'Табы на главной' ),
            'singular_name'   => __( 'Элементы' ),
            'add_new'         => __( 'Добавить' ),
            'add_new_item'    => __( 'Добавить новый элемент' ),
            'edit'            => __( 'Редактировать' ),
            'edit_item'       => __( 'Редактировать элемент' ),
            'new_item'        => __( 'Новый элемент' ),
            'all_items'       => __( 'Все элементы из табов на главной' ),
            'view'            => __( 'Просмотреть' ),
            'view_item'       => __( 'Просмотреть элемент' ),
            'search_items'    => __( 'Поиск' ),
            'not_found'       => __( 'Не удалось найти' ),
        ],
        'public' => true,
        'menu_position' => 2,
        'supports' => ['title', 'thumbnail', 'excerpt', 'custom-fields'],
        'has_archive' => false,
        'capability_type' => 'post',
        'menu_icon'   => 'dashicons-admin-page',
    ]);
}

add_action( 'init', 'mainpage_tab_item' );

/**
 * Удалить seo метабокс для этого post_type
 */

function mainpate_tab_item_remove_seo() {
    remove_meta_box('wpseo_meta', 'mainpage_tab_item', 'normal');
}
add_action('add_meta_boxes', 'mainpate_tab_item_remove_seo', 100);

/**
 * Урл страницы для элемента направления
 */

function direction_landing_url() {
    add_meta_box(
        'direction_landing_url',
        __('URL лэндинга'),
        'direction_landing_url_callback',
        'direction_item'
    );
}

add_action('add_meta_boxes', 'direction_landing_url');

function direction_landing_url_callback($post) {
    wp_nonce_field(basename(__FILE__), 'direction_landing_url');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <input required type="text" size="100"
           name="direction_landing_url"
           id="direction_landing_url"
           value="<?php if ( isset ( $links_stored_meta['direction_landing_url'] ) ) echo $links_stored_meta['direction_landing_url'][0]; ?>"/>
    <?php
}

/**
 * Cохранение
 */

function direction_landing_url_save( $post_id ) {
    if( isset( $_POST[ 'direction_landing_url' ] ) ) {
        update_post_meta( $post_id, 'direction_landing_url', $_POST[ 'direction_landing_url' ] );
    }
}

add_action('save_post', 'direction_landing_url_save');

/**
 * Выбор категории для табов на главной
*/

function mainpage_tab_category() {
    add_meta_box(
        'mainpage_tab_category',
        __('Категория таба'),
        'mainpage_tab_category_callback',
        'mainpage_tab_item'
    );
}

add_action('add_meta_boxes', 'mainpage_tab_category');


function mainpage_tab_category_callback($post) {

    global $tabArray;

    wp_nonce_field(basename(__FILE__), 'mainpage_tab_category');
    $links_stored_meta = get_post_meta( $post->ID );

    ?>
    <select name="mainpage_tab_category" id="mainpage_tab_category">
        <?php foreach ($tabArray as $key => $value) : ?>
            <option value="<?=$key?>" <?=(isset($links_stored_meta['mainpage_tab_category']) &&
            ((int)$links_stored_meta['mainpage_tab_category'][0] === $key ) ? 'selected' : '')?>><?=$value?></option>
        <?php endforeach ; ?>
    </select>

    <?php
}

/**
 * Cохранение
 */

function mainpage_tab_category_save( $post_id ) {
    if( isset( $_POST[ 'mainpage_tab_category' ] ) ) {
        update_post_meta( $post_id, 'mainpage_tab_category', sanitize_text_field( $_POST[ 'mainpage_tab_category' ] ) );
    }
}

add_action('save_post', 'mainpage_tab_category_save');

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
 * Текст для слайда на плашке
 */

function portfolio_slide_text() {
    add_meta_box(
        'pt_slide_text',
        __('Текст для слайда на плашке'),
        'portfolio_slide_text_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_slide_text');

function portfolio_slide_text_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_slide_text');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <input required type="text" size="100"
           name="pt_slide_text"
           id="pt_slide_text"
           value="<?php if ( isset ( $links_stored_meta['pt_slide_text'] ) ) echo $links_stored_meta['pt_slide_text'][0]; ?>"/>
    <?php
}

/**
 * Cохранение
 */

function portfolio_slide_text_save( $post_id ) {
    if( isset( $_POST[ 'pt_slide_text' ] ) ) {
        update_post_meta( $post_id, 'pt_slide_text', sanitize_text_field( $_POST[ 'pt_slide_text' ] ) );
    }
}

add_action('save_post', 'portfolio_slide_text_save');


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
 * Блок с таблицой для портфолио
*/

function portfolio_table() {
    add_meta_box(
        'pt_table',
        __(' Блок таблицы'),
        'portfolio_table_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_table');

function portfolio_table_callback($post) {

    $links_stored_meta = get_post_meta( $post->ID, 'pt_table', true );

    wp_editor( $links_stored_meta, 'pt_table_editor', array(
        'media_buttons' => false,
        'textarea_name' => 'pt_table',
        'textarea_rows' => 10,
        'tabfocus_elements' => 'content-html,save-post',
        'tinymce' => array(
            'resize' => false,
            'add_unload_trigger' => false,
        ),
        'autop' => false,

    ) );




}

/**
 * Cохранение
 */

function portfolio_table_save( $post_id ) {

    if( isset( $_POST[ 'pt_table' ] ) ) {

        update_post_meta( $post_id, 'pt_table',  $_POST[ 'pt_table' ] );
    }
}

add_action('save_post', 'portfolio_table_save');

/**
 * Блок видео для портфолио
 */

function portfolio_video() {
    add_meta_box(
        'pt_video',
        __(' Блок видео'),
        'portfolio_video_callback',
        'portfolio_item'
    );
}

add_action('add_meta_boxes', 'portfolio_video');


function portfolio_video_callback($post) {
    wp_nonce_field(basename(__FILE__), 'pt_video');
    $links_stored_meta = get_post_meta( $post->ID );
    ?>
    <textarea style="width:100%"
              name="pt_video_original"
              id="pt_video_original">
        <?php if ( isset ( $links_stored_meta['pt_video'] ) ) echo $links_stored_meta['pt_video'][0]; ?>
    </textarea>
    <?php
}

/**
 * Cохранение
 */

function portfolio_video_save( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'pt_video' ] ) && wp_verify_nonce( $_POST[ 'pt_video' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if( isset( $_POST[ 'pt_video_original' ] ) ) {
        update_post_meta( $post_id, 'pt_video', sanitize_text_field( $_POST[ 'pt_video_original' ] ) );
    }
}

add_action('save_post', 'portfolio_video_save');

/**
 * Поле большой картинки в портфолио
 */
function portfolio_custom_image_one() {
    add_meta_box(
        'pt_custom_image_one',
        __('Баннер большой'),
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
           id="pst_short_text_original">
        <?php if ( isset ( $links_stored_meta['pst_short_text_original'] ) ) echo $links_stored_meta['pst_short_text_original'][0]; ?>
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
        add_image_size('portfolio-banner', 1585, 691, true);
        add_image_size('portfolio-screenshoot-one', 900, false, true);


        add_image_size('direction', 135, 126, true);

        add_image_size('events', 281, 186, true);
        add_image_size('event-single', 298, 216, true);

        add_image_size('client-thumb', 162, 162);
        add_image_size('client-list', 324, 262, true);
        add_image_size('client-others', 333, 273, true);


        add_image_size('slide', 187, 103, true);

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
        pll_register_string('Мы сформируем вам правильную стратегию ведения рекламы и продвижению сайта  в интернете, что обеспечивает максимальное увеличение продаж на любом уровне. Благодаря продвижению сайта и интернет рекламе вы получите стабильный поток клиентов.',
            'Мы сформируем вам правильную стратегию ведения рекламы и продвижению сайта  в интернете, что обеспечивает максимальное увеличение продаж на любом уровне. Благодаря продвижению сайта и интернет рекламе вы получите стабильный поток клиентов.',
            'SDC');
        pll_register_string('О компании', 'О компании', 'SDC');

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
         * request-project.php
        */

        pll_register_string('Заполните заявку и мы свяжимся с вами', 'Заполните заявку и мы свяжимся с вами', 'SDC');
        pll_register_string('Название компании', 'Название компании', 'SDC');
        pll_register_string('Расскажите в кратце о своем проекте', 'Расскажите в кратце о своем проекте', 'SDC');

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

        /**
         * Landing SMM
        */

        pll_register_string('СММ', 'СММ', 'SDC');
        pll_register_string('Преимущества рекламы в социальных сетях', 'Преимущества рекламы в социальных сетях', 'SDC');
        pll_register_string('Что мы сделаем для вас?', 'Что мы сделаем для вас?', 'SDC');
        pll_register_string('Команда, которая будет работать над вашим проектом', 'Команда, которая будет работать над вашим проектом', 'SDC');
        pll_register_string('Профессиональное продвижение SMM от Smart Digital', 'Профессиональное продвижение SMM от Smart Digital', 'SDC');
        pll_register_string('Работаем по технологии Data - driven Marketing', 'Работаем по технологии Data - driven Marketing', 'SDC');

    }
endif; // sdc setup

add_action( 'after_setup_theme', 'sdc_setup' );

/**
 * Настройки темы
*/

add_action('admin_menu', function(){
    add_theme_page('Настроить тему SDC', 'Настроить тему SDC', 'edit_theme_options', 'customize.php');
});

add_action('customize_register', function($customizer) {

    $customizer->add_section(
        'section_one', [
            'title' => 'Настройки сайта',
            'description' => '',
            'priority' => 11,
        ]
    );

    $customizer->add_setting('mainBanner');

    $customizer->add_control(new WP_Customize_Image_Control($customizer, 'mainBanner', [
        'label'    => 'Главный баннер',
        'section'  => 'section_one',
        'settings' => 'mainBanner',
    ]));

});


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

if (! function_exists('sdc_is_portfolio_page')) :
    /**
     * Check if portfolio page
    */
    function sdc_is_portfolio_page() {
        return strpos($_SERVER['REQUEST_URI'], 'portfolio') !== false;
    }

endif;

if (! function_exists('sdc_is_clients_page')) :
    /**
     * Check if clients page
     * @return bool
     */
    function sdc_is_clients_page() {
        return strpos($_SERVER['REQUEST_URI'], 'clients') !== false;
    }

endif;

if (! function_exists('sdc_is_events_page')) :
    /**
     * Check if events page
     * @return bool
     */
    function sdc_is_events_page() {
        return strpos($_SERVER['REQUEST_URI'], 'events') !== false;
    }

endif;

if (! function_exists('sdc_is_contacts_page')) :
    /**
     * Check if contacts page
     * @return bool
     */
    function sdc_is_contacts_page() {
        return strpos($_SERVER['REQUEST_URI'], 'contacts') !== false;
    }

endif;

if (! function_exists('sdc_is_direction_page')) :
    /**
     * Check if contacts page
     * @return bool
     */
    function sdc_is_direction_page() {
        return strpos($_SERVER['REQUEST_URI'], 'direction') !== false;
    }

endif;

if (! function_exists('sdc_is_current_category')) :
    /**
     * Check if contacts page
     * @return bool
     */
    function sdc_is_current_category($slug) {
        return strpos($_SERVER['REQUEST_URI'], 'slug') !== false;
    }

endif;

if (! function_exists('sdc_check_if_children_exists')) {

    /**
     * Check if category has children
     * @param  WP_Term $term
     * @return bool
    */

    function sdc_check_if_children_exists($term) {
        global $wpdb;

        $exist = $wpdb->get_results(" SELECT COUNT FROM wp_term_taxonomy WHERE parent = '$term->term_id' ");
        if (!$exist) {
            return false;
        }
        return true;
    }
}


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

if (! function_exists( 'sdc_is_video' )) :

    /**
     * check if file is video
    */

    function sdc_is_video($filename) {

        if(preg_match('/^.*\.(mp4|mov|mpg|mpeg|wmv|mkv)$/i', $filename)) {
            return true;
        }

        return false;
    }

endif;

/**
 * Globals for nav menu on main
 */

$portfolioPage = sdc_get_portfolio_category();
$contactsPage = sdc_get_contacts_page();
$eventsPage = sdc_get_events_category();
$clientsPage = sdc_get_clients_category();
$directionPage = sdc_get_direction_category();

