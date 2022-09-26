<?php

class App{


    private function __construct(){
    }

    public static function Init_one(){
        
        //OBTENGO LA URL Y SE DESGLOZA
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = trim($url, '/');
        $url = explode('/', $url);


        if(empty($url[0])){ //CONTROLADOR
            include_once "controllers/object.controller.php";
            $controller = new ObjectController();
            return;
        }else{

            include_once "controllers/".$url[0].".controller.php";
            $controller = new $url[0]();
            
            if(!empty($url[1])){ //METODO

                if(method_exists($controller, $url[1])){ //SI EL METODO EXISTE
                    
                    if(isset($url[2])){ //ARGS

                        
                        
                    }else{ //NO ARGS
                    }

                    return;
                }

                echo 'Metodo no existe';

            }
        }

        
        

    }

}

?>
