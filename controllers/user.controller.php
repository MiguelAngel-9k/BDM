<?php
/* 
        TODO

    1.- REVISAR SI YA HAY UNA SESION INICIADA.
    2.- DE SER ASI REDIRIGIR A LANDING PAGE.
    3.- DE NO SER ASI REDIRIGIR A REGISTER.

*/
echo 'User controller class';
class User{
    
    public function __construct(){


        
        session_start();
        if(!isset($_SESSION['UMAIL'])){
            require "views/user/register.php";
            // return;
        }

        // require "views/user/landing.php";
        return;

    }

    public function register(){

        /* 
                TODO

            .- VALIDAR EL CORREO
            .- VALIDAR LA CONTRASENIA
            .- VALIDAR EL PASSWORD
            .- VALIDAR EL NOMBRE


        */

        echo $this->existsPOST(array('email', 'nickname', 'pwd', 'name'));

    }

    private function existsPOST($keys){
        foreach($keys as $key){
            if(!isset($_POST[$key])){
                return `Missing {$key}`;
                break;
            }
        }

        return;
    }
}

?>