<?php

class View{

    private $path;
    private $data;

    public function View($name, $data=[]){
        ob_start();
        $this->name = $name;
        $this->data = $data;
        require_once(dirname(__DIR__).'../views/'.$name.'.php');
        $output = ob_get_clean();
        return $output;
    }
}