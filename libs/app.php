<?php

class App{


    private function __construct(){
    }

    public static function Init_one(){
        
        //OBTENGO LA URL Y SE DESGLOZA
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = trim($url, '/');
        $url = explode('/', $url);

        // $controller = !empty($url[0]) ? $url[0] : null;

        if(empty($url[0])){
            // var_dump(empty($url[0]));
            include_once "controllers/object.controller.php";
            $controller = new ObjectController();
            return;
        }else{

            include_once "controllers/".$url[0].".controller.php";
            $controller = new $url[0]();
            
            if(empty($url[1])){
                
            }
        }

        
        

    }

}

?>
