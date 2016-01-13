<?php
/*
Plugin Name: Location Reminder
Plugin URI:
Description: Handy plugin to display the server IP everywhere you go, Usefull for developers that work with test server and live server at the same time.
Author: Max Ottenhof
Version: 1.3
Author URI: http://maxminded.com
*/
//deze functie wordt uigevoerd zodra de plugin wordt geinstalleerd
function maxminded_locationreminder_install() {
    //de database prefix wordt hier opgehaald
    global $wpdb;
    //de naam van de tabellen worden hier  gemaakt
    $table_name = $wpdb->prefix . "maxminded_locationreminder";
    
    //iets met speciale tekens doen zodat er geen fouten ontstaan
    $charset_collate = $wpdb->get_charset_collate();

    //de structuur van de tabellen wordt hier aangemaakt
    $create_table ="CREATE TABLE $table_name (`id` INT(3) NOT NULL AUTO_INCREMENT , `optie` VARCHAR(255) NOT NULL , `position` VARCHAR(255) NOT NULL , `color` VARCHAR(255) NOT NULL , `opacity` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) $charset_collate;";

    //de tabellen worden hier in de database gezet.. upgrade.php is hiervoor nodig
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $create_table );
    
    $result = $wpdb->get_results("SELECT id from $table_name");
    if(count($result) == 0)
    {
        //opties aanmaken
        $table ="insert into $table_name (optie,position,color,opacity) VALUES ('Localhost','bottom: 20px; left: 20px;','#FF6500','1')";
        $wpdb->query($table);
    }
    else
    {
        //do nothing
    } 
}

// Hook for adding admin menus
add_action('admin_menu', 'maxminded_locationreminder_add_pages');

// action function for above hook
function maxminded_locationreminder_add_pages() {
    // Add a new top-level menu (ill-advised):
    add_menu_page(__('Location Reminder','Location Reminder'), __('Location Reminder','Location Reminder'), 'manage_options', 'Location Reminder', 'maxminded_locationreminder_option_page' );
}
// Lreminder_toplevel_page() displays the page content for the custom Test Toplevel menu
function maxminded_locationreminder_option_page() {
    include'options_page.php';
}
//dit is nodig voor de functie om te zien dat het geinstalleerd wordt.
register_activation_hook( __FILE__, 'maxminded_locationreminder_install' );
register_activation_hook( __FILE__, 'maxminded_locationreminder_install_data' );
//html toevoegen
function maxminded_locationreminder_html() {
   include 'reminderdesign.php';
}
add_action('admin_footer', 'maxminded_locationreminder_html');
add_action('wp_footer', 'maxminded_locationreminder_html');

//css toevoegen
function maxminded_locationreminder_css() {
    wp_enqueue_style('my-admin-theme', plugins_url('css/wp-admin.css', __FILE__));
}

//html frontend
add_action('admin_enqueue_scripts', 'maxminded_locationreminder_css');
add_action('login_enqueue_scripts', 'maxminded_locationreminder_css');
add_action('wp_enqueue_scripts', 'maxminded_locationreminder_css');