<?php

require_once __DIR__."/../core/View.php";

/**
 * @description Create menu admin view and render for plugin
 */

 class AdminPage{
     /**
      * This function renders contents to page admin
      */
      public function show(){
          echo View::render('admin');
      }
 }

?>