<?php

class Product extends Controller{

    public function __construct(){
        parent:: __construct();
    }

    public function render(){
        $view = 'views/object/landing.php';
        if(file_exists($view)){
            require $view;
        }
    }

    public function newProduct(){


    }
}

?>