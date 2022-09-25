<?php

class App{


    private function __construct(){
    }

    public static function Init_one(){
        
        //OBTENGO LA URL Y SE DESGLOZA
        $url = isset($_GET['dir']) ? $_GET['dir'] : null;
        $url = trim($url, '/');
        $url = explode('/', $url);

        $controller = !empty($url[0]) ? $url[0] : null;

        if($controller == null){
            // var_dump(empty($url[0]));
            include_once "controllers/user.controller.php";
            $controller = new UserController();
        }
        

    }

}

?>
