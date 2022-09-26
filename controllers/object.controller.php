<?php

class ObjectController{

    public function __construct(){
        session_start();
        if(!isset($_SESSION['UMAIL'])){
            require "views/user/register.php";
            // return;
        }

        // require "views/user/landing.php";
        return;
    }

    public function render($url, $data=[]){

    }
}

?>