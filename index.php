<?php
require_once __DIR__."/vendor/autoload.php";

require_once __DIR__."/config/Menu.php";
require_once __DIR__."/config/AdminPage.php";
require_once __DIR__."/config/GalleryHandler.php";

defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

/**
 * Plugin Name: Iapy Gallery
 * Description: Gallery to Images and Videos
 * Version: 1.0
 * Author: iapy dev
 * Author URI: https://github.com/silvablack/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

// Set action ´fg_plugin_settings´ to plugin loaded
add_action('plugins_loaded', 'run');

// Instance class and init aplication
function run(){
    $plugin = new Menu(new AdminPage());
    $hook = new GalleryHandler();
}


?>