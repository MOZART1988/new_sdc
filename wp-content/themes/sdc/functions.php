<?php
/**
 * functions.php for theme SDC
*/
if ( ! function_exists( 'sdc_the_custom_logo' ) ) :
    /**
     * Displays the optional custom logo.
     *
     * Does nothing if the custom logo is not available.
     *
     */
    function sdc_the_custom_logo() {
        return '<a href="/" class="logo">
            <img src="/img/logo.png"><span>smartdigital</span>
            </a>';
    }
endif;
if (! function_exists('sdc_footer_logo')) :
    /**
     * Displays footer logo
    */

    function sdc_footer_logo() {
        return '<a href="/"><img src="/img/logo.png"></a>';
    }

endif;

