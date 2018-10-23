<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

require_once __DIR__."/../core/View.php";
require_once __DIR__."/../controllers/GalleryController.php";

/**
 * @since 1.0.0
 * @description Class to Gallery Handler
 */
class GalleryHandler{

    /**
     * @since 1.0.0
     * @description Constructor to build class and add short code in wordpress
     */
    public function GalleryHandler(){
        add_shortcode('full_gallery',array($this, 'show'));
        wp_register_style('lightgallery_styles', plugin_dir_url(__DIR__).'node_modules/lightgallery/dist/css/lightgallery.min.css');
        wp_enqueue_style('lightgallery_styles');
        wp_register_style('gallery_front_styles', plugin_dir_url(__DIR__).'assets/css/gallery.front.css');
        wp_enqueue_style('gallery_front_styles');
        wp_register_script('jquery_3_3_1', plugin_dir_url(__DIR__).'node_modules/jquery/dist/jquery.min.js');
        wp_enqueue_script('jquery_3_3_1');
        wp_register_script('gallery_front', plugin_dir_url(__DIR__).'assets/js/gallery.front.js',['jquery_3_3_1']);
        wp_enqueue_script('gallery_front');
        wp_register_script('lightgallery', plugin_dir_url(__DIR__).'node_modules/lightgallery/dist/js/lightgallery.min.js',['jquery_3_3_1']);
        wp_enqueue_script('lightgallery');
        wp_register_script('lg-fullscreen', plugin_dir_url(__DIR__).'node_modules/lg-fullscreen/dist/lg-fullscreen.min.js',['lightgallery']);
        wp_enqueue_script('lg-fullscree');
        wp_register_script('lg-autoplay', plugin_dir_url(__DIR__).'node_modules/lg-autoplay/dist/lg-autoplay.min.js',['lightgallery']);
        wp_enqueue_script('lg-autoplay');
        wp_register_script('lg-video', plugin_dir_url(__DIR__).'node_modules/lg-video/dist/lg-video.min.js',['lightgallery']);
        wp_enqueue_script('lg-video');
        
        
    }

    /**
     * @since 1.0.0
     * @description function to show view
     */
    public function show(){
        $controller = new GalleryController();
        return View::render('gallery', ['data'=>$controller->getGallery()]);
    }

}
?>