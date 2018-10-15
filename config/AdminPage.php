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
     /**
      * @since 1.0.0
      * @description This function renders contents to page admin
      */
      public function show(){
          echo View::render('admin');
      }
 }

?>