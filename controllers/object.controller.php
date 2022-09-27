<?php

class Product extends Controller{

    public function __construct(){
        parent:: __construct();
        // require "views/user/landing.php";
        return;
    }

    public function render($url, $data=[]){
        $view = "views/object/$url.php";
        require $view;
    }

    public function newProduct(){


    }
}

?>