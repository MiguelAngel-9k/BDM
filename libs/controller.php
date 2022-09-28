<?php

class Controller{

    public function __construct(){
        session_start();

        if(!isset($_SESSION['USER'])){
            $this->render('user/register');
            return;
        }

    }

    public function render($path, $data=[]){

        $url = explode('/', $path);
        $view = "views/$url[0]/$url[1].php";
        
        if(file_exists($view)){
            require "views/$url[0]/$url[1].php";
        }

        return;

    }

    public function existsPOST($keys)
    {
        foreach ($keys as $key) {
            if (!isset($_POST[$key])) {
                return false;
            }
        }

        return true;
    }
    
}

?>