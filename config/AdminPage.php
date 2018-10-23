<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );
// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

require_once __DIR__."/../core/View.php";

require_once __DIR__.'/../controllers/GalleryController.php';

/**
 * @since 1.0.0
 * Create menu admin view and render for plugin
 */
 class AdminPage{
    
    public function AdminPage(){
        /**
         * Register scripts and style in admin enqueue
         */
        add_action('admin_enqueue_scripts', function(){
            wp_register_style('gallery_pre_style', plugin_dir_url(__DIR__).'assets/css/wp_fgallery.css');
            wp_enqueue_style('gallery_pre_style');
            wp_register_script('jquery_3_3_1', plugin_dir_url(__DIR__).'node_modules/jquery/dist/jquery.min.js');
            wp_enqueue_script('jquery_3_3_1');
            wp_register_script('gallery_pre', plugin_dir_url(__DIR__).'assets/js/gallery.js',['jquery_3_3_1']);
            wp_enqueue_script('gallery_pre');
            wp_localize_script('gallery_pre', 'pathPlugin', array('url'=> plugin_dir_url(__DIR__))); // send path plugin url to script
            wp_localize_script('gallery_pre', 'Ajax', array('url'=> admin_url('admin-ajax.php'))); // declare url of file to ajax request
            
        });
        /**
         * Register ajax scripts
         */
        add_action('wp_ajax_saveGallery',array($this,'saveGallery'));
        add_action('wp_ajax_nopriv_saveGallery',array($this,'saveGallery'));

        add_action('wp_ajax_getGallery',array($this,'getGallery'));
        add_action('wp_ajax_nopriv_getGallery',array($this,'getGallery'));

        add_action('wp_ajax_deleteMedia',array($this,'deleteMedia'));
        add_action('wp_ajax_nopriv_deleteMedia',array($this,'deleteMedia'));
    }

    /**
     * Get all files of Gallery Images and Videos
     */
    public function getGallery(){
        $controller = new GalleryController();
        echo json_encode($controller->getGallery());
        exit;
    }

    /**
     * Save media files on database
     */
    public function saveGallery(){
        $controller = new GalleryController();
        echo json_encode($controller->saveGallery($_POST['data']));
        exit;
    }

    /**
     * Delete media file and remove registry
     */
    public function deleteMedia(){
        $controller = new GalleryController();
        echo json_encode($controller->removeMedia($_POST['id']));
        exit;
    }
    
    /**
      * This function renders contents to page admin
      */
      public function show(){
          echo View::render('admin');
      }
 }

?>