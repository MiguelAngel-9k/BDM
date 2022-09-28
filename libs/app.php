<?php

class App{


    private function __construct(){
    }

    public static function Init_one(){
        
        //OBTENGO LA URL Y SE DESGLOZA
        $url = isset($_GET[constant('URL')]) ? $_GET[constant('URL')] : null;
        $url = trim($url, '/');
        $url = explode('/', $url);


        if(empty($url[0])){ //CONTROLADOR
            include_once "controllers/object.controller.php";
            $controller = new Product();
            // $controller->render('landing');
            return;
        }else{

            include_once "controllers/".$url[0].".controller.php";
            $controller = new $url[0]();
            
            if(!empty($url[1])){ //METODO

                if(method_exists($controller, $url[1])){ //SI EL METODO EXISTE
                    
                    if(isset($url[2])){ //ARGS

                        var_dump(array_slice($url, 2));
                        
                    }else{ //NO ARGS
                        $controller->{$url[1]}();
                    }

                    return;
                }

                echo 'Metodo no existe';

            }
        }

    }

}
