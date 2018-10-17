<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

require_once __DIR__."/../core/View.php";

/**
 * @since 1.0.0
 * @description Create menu admin view and render for plugin
 */
 class AdminPage{
    
    public function AdminPage(){
        add_action('admin_enqueue_scripts', function(){
            wp_register_style('gallery_pre_style', plugin_dir_url(__DIR__).'assets/css/wp_fgallery.css');
            wp_enqueue_style('gallery_pre_style');
            wp_register_script('gallery_pre', plugin_dir_url(__DIR__).'assets/js/gallery.js',['jquery_3_3_1']);
            wp_enqueue_script('gallery_pre');
            wp_localize_script('gallery_pre', 'pathPlugin', array('url'=> plugin_dir_url(__DIR__))); // send path plugin url to script
            wp_register_script('jquery_3_3_1', plugin_dir_url(__DIR__).'assets/js/jquery-3.3.1.min.js');
            wp_enqueue_script('jquery_3_3_1');
        });
    }
    
    /**
      * @since 1.0.0
      * @description This function renders contents to page admin
      */
      public function show(){
          echo View::render('admin');
      }
 }

?>