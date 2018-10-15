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

// Set action function to plugin loaded
add_action('plugins_loaded', function(){ # Instance class and init aplication
 // register and configure admin menu
 $plugin = new Menu(new AdminPage());

 // register hook to show gallery
 $hook = new GalleryHandler();
});


?>