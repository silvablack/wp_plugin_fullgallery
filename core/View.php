<?php
defined ( 'ABSPATH' ) or die ( 'No script kiddies please' );

// Not permission to directly access 
if(!defined('WPINC')){
     die;
}

class View{

    /**
     * @since 1.0.0
     * @description Renderizing views file and send data
     * @param $name Name is the name of view file
     * @param $data Data is the responsity variable for receive data and send to view file
     */

    public static function render($name, $data = array()){
        ob_start();
        extract($data);
        require_once(dirname(__DIR__).'/views/'.$name.'.php');
        $output = ob_get_clean();
        return $output;
    }
}