<?php
/*
*Plugin Name:wpacademy2
*Plugin URI:https://wpacademy.pk2
*Author:wpacademy2
*Author URI:https://wpacademy.pk2
*Description: simple hello world
*Version:1.0.0
*License:GPL 2
*License URI: https://www.gnu.org/license/gpl-2.0.0html
*Text Domain:wpacLike
*/

function wpacademy_litttle_filter_example2($words){
    return 5;
}
add_filter('excerpt_length','wpacademy_litttle_filter_example2');

function wpacademy_litttle_filter_example($more){
    $more='<a href="'.get_the_permalink().'"> more</a>';
    return $more;
}
add_filter('excerpt_more','wpacademy_litttle_filter_example');
// function wpdocs_excerpt_more2( $more ) {
//     return sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
//           esc_url( get_permalink( get_the_ID() ) ),
//           sprintf( __( 'Continue reading %s', 'wpdocs' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
//     );
// }
// add_filter( 'excerpt_more', 'wpdocs_excerpt_more2' );


////
//function prevents to direct access

if(!defined('WPINC')){
    die;
}


///NOTE:- IN WP_CONFIG FILE ENABLE WP_DEBUG:false
// function checking for varaibles if exist the it is not created , for version
if(!defined('WPAC_PLUGIN_VERSION')){
    define('WPAC_PLUGIN_VERSION','1.0.0');
}

// for directory
if(!defined('WPAC_PLUGIN_DIR')){
    define('WPAC_PLUGIN_DIR',plugin_dir_url(__FILE__));
}
//FUNCTION for checking function exist or not if exist it is not created

// if(!function_exists('wpac_my_plugin_function')){
//     function wpac_my_plugin_function(){

//     }
// }
//
//ADDING CSS AND JAVASCRIPT FILE
if(!function_exists('wpac_plugin_scripts')){
    function wpac_plugin_scripts(){
        wp_enqueue_style('wpac-css',WPAC_PLUGIN_DIR.'assets/css/style.css');
        
        wp_enqueue_script('wpac-js',WPAC_PLUGIN_DIR.'assets/js/main.js','jQuery','1.0.0',true);
        wp_enqueue_script('wpac-ajax',WPAC_PLUGIN_DIR.'assets/js/ajax.js','jQuery','1.0.0',true);
    
    
        wp_localize_script('wpac-ajax','wpac_ajax_url', array(
            'ajax_url'=>admin_url('admin-ajax.php')
        ));
    }

    add_action('wp_enqueue_scripts','wpac_plugin_scripts');
}


///
//REGISTERING PLUGIN MENU , 
// 
// add_menu_page(page_title, menu_title,menu_slug, function, icon_url,position);

// for menu
function wpac_register_menu_page(){
    add_menu_page('WPAC like System','WPAC Settings','manage_options','wpac-settings','wpac_settings_page_html','dashicons-thumbs-up',30);

}
add_action('admin_menu','wpac_register_menu_page');

// 1. sub menu
function wpac_register_submenu_page(){
    add_submenu_page('tools.php','WPAC like System','WPAC Settings','manage_options','wpac-settings',
    'wpac_settings_page_html',30);

}
add_action('admin_menu','wpac_register_submenu_page');


// 2. direct by using predefined functions ,it direct adds in menu
function wpac_register_submenu_page2(){
    add_options_page('WPAC like System','WPAC Settings','manage_options','wpac-settings',
    'wpac_settings_page_html',30);

}
add_action('admin_menu','wpac_register_submenu_page2');


////////////////---------plugin setting page------------------------------------------------
require plugin_dir_path(__File__).'inc/settings.php';
//create table for our plugin
// require plugin_dir_path(__File__).'inc/db.php';

function wpac_likes_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'wpac_like_system';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time timestamp DEFAULT '0000-00-00 00:00:00' NOT NULL,
    
user_id mediumint(9) NOT NULL,
post_id mediumint(9) NOT NULL,
like_count mediumint(9) NOT NULL,
dislike_count mediumint(9) NOT NULL,

        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


register_activation_hook(__FILE__,'wpac_likes_table');


/// create like dislike button using filter.
require plugin_dir_path(__File__).'inc/btns.php';
//wpac plugin Ajax function
function wpac_like_btn_ajax_action(){

    echo 'Ajax Success';
    wp_die();
}
add_action('wp_ajax_wpac_like_btn_ajax_action','wpac_like_btn_ajax_action');
add_action('wp_ajax_nopriv_wpac_like_btn_ajax_action','wpac_like_btn_ajax_action');

?>














