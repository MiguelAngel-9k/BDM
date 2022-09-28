<?php

class Product extends Controller{

    public function __construct(){
        parent:: __construct();
        // require "views/user/landing.php";
        return;
    }

    public function render($path, $data=[]){
        echo 'product controller render';
    }

    public function newProduct(){


    }
}

?>