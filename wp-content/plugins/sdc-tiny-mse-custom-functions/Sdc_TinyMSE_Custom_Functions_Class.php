<?php
/**
 * Plugin Name: TinyMCE SDC Custom Functions
 * Plugin URI: http://new.sd-c.kz
 * Version: 1.0
 * Author: Ivan Mosiagin
 * Author URI: https://www.youtube.com/channel/UC4nxPtgIZ-gy5TAhWJWXyRQ
 * Description: Плагин для дополнительных возможностей редактора tiny mse для сайта SDC
 * License: GPL2
 */

class Sdc_TinyMSE_Custom_Functions_Class {

    public function __construct() {
        if ( is_admin() ) {
            add_action( 'init', [ $this, 'setup_tinymce_plugin' ] );
        }
    }

    /**
     * Check if the current user can edit Posts or Pages, and is using the Visual Editor
     * If so, add some filters so we can register our plugin
     */
     public function setup_tinymce_plugin() {

        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }

        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }

        add_filter( 'mce_external_plugins', [ &$this, 'add_tinymce_plugin' ] );
        add_filter( 'mce_buttons', [ &$this, 'add_tinymce_toolbar_button' ] );

    }

    /**
     * Adds a TinyMCE plugin compatible JS file to the TinyMCE / Visual Editor instance
     *
     * @param array $plugin_array Array of registered TinyMCE Plugins
     * @return array Modified array of registered TinyMCE Plugins
     */
    public function add_tinymce_plugin( $plugin_array ) {

        $plugin_array['custom_text_block'] = plugin_dir_url( __FILE__ ) . 'sdc-tinymce-custom-functions-class.js';
        $plugin_array['screenshot_block'] = plugin_dir_url(__FILE__) . 'sdc-tinymce-custom-functions-class.js';
        return $plugin_array;

    }

    /**
     * Adds a button to the TinyMCE / Visual Editor which the user can click
     * to insert a link with a custom CSS class.
     *
     * @param array $buttons Array of registered TinyMCE Buttons
     * @return array Modified array of registered TinyMCE Buttons
     */
    public function add_tinymce_toolbar_button( $buttons ) {

        array_push( $buttons, '|', 'custom_text_block' );
        array_push( $buttons, '|', 'screenshot_block' );

        return $buttons;
    }
}

$sdc_tiny_mse_custom_functions = new Sdc_TinyMSE_Custom_Functions_Class;