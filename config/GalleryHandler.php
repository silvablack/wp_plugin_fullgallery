<?php

namespace FGallery\Config;

class GalleryHandler{

    public function GalleryHandler(){
        add_shortcode('full_gallery',array($this, 'render'));
    }

    public function render(){
        $data = array('var1'=>'imagem 1', 'var2'=>'imagem 2');
        return 'Olá';
    }

}
?>