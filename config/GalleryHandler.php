<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

require_once __DIR__."/../core/View.php";

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
    }

    /**
     * @since 1.0.0
     * @description function to show view
     */
    public function show(){
        $data = array('var1'=>'imagem 1', 'var2'=>'imagem 2');
        return View::render('gallery', ['var'=>'Paulo']);
    }

}
?>