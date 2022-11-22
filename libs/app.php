<?php

class App{


    private function __construct(){
    }

    public static function Init_one(){
        
        //OBTENGO LA URL Y SE DESGLOZA
        $url = isset($_GET[constant('URL')]) ? $_GET[constant('URL')] : null;
        $url = trim($url, '/');
        //    controlador/metodo/parametro
        $url = explode('/', $url);
        //    controlador/metodo/parametro



        if(empty($url[0])){ //CONTROLADOR
            include_once "controllers/user.controller.php";
            $controller = new User();
            $controller->render('');
            return;
        }else{

            include_once "controllers/".$url[0].".controller.php";
            $controller = new $url[0]();
            
            if(!empty($url[1])){ //METODO

                if(method_exists($controller, $url[1])){ //SI EL METODO EXISTE
                    
                    if(isset($url[2])){ //ARGS

                        $controller->{$url[1]}(array_slice($url, 2));
                        // var_dump(array_slice($url, 2));
                        
                    }else{ //NO ARGS
                        $controller->{$url[1]}();
                    }

                    return;
                }

                echo 'Metodo no existe';

            }else{
                echo "no controlador";
            }
        }

    }

}
