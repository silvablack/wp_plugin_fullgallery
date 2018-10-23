<?php
require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/config/Menu.php";
require_once __DIR__."/config/AdminPage.php";
require_once __DIR__."/config/GalleryHandler.php";


/**
 * Plugin Name: Iapy Gallery
 * Description: Gallery to Images and Videos
 * Version: 1.0
 * Author: iapy dev
 * Author URI: https://github.com/silvablack/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

/**
 * @description Register hook when activate plugin and make structure for data storage
 */
register_activation_hook(__FILE__, function(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix.'full_gallery';
    $sql = "
    CREATE TABLE $table_name(
        id int(9) NOT NULL AUTO_INCREMENT,
        created_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
        source longtext NOT NULL,
        description TEXT NULL DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;
    ";
    require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
});

// Set action function to plugin loaded
add_action('plugins_loaded', function(){ # Instance class and init aplication
    
 // register and configure admin menu
 $plugin = new Menu(new AdminPage());

 // register hook to show gallery
 $hook = new GalleryHandler();
});


?>