<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

require_once __DIR__."/../core/View.php";


class GalleryHandler{

    public function GalleryHandler(){
        add_shortcode('full_gallery',array($this, 'show'));
    }

    public function show(){
        $data = array('var1'=>'imagem 1', 'var2'=>'imagem 2');
        return View::render('gallery', ['var'=>'Paulo']);
    }

}
?>