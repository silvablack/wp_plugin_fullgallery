<?php

namespace FGallery\Config;

/**
 * @description Create menu admin view and render for plugin
 */

 class AdminPage{
     /**
      * This function renders contents to page admin
      */
      public function render(){
          echo __DIR__.'';
          echo '<div class="wrap">';
            echo '<h1>IAPY Gallery - Image and Video</h1>';
            echo '<div class="fg-iapy">';
                echo '<form method="post">';
                    echo '<input type="file" name="fg_iapy[]" />';
                echo '</form>';
                echo '<div id="iapy_preview"></div>';
            echo '</div>';
          echo '</div>';
      }
 }

?>