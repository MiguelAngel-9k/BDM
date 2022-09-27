<?php

class User extends Controller
{

    public function __construct()
    {

        parent::__construct();

        session_start();

        if(isset($_SESSION['user'])){
            
        }

        //PAGINA POR DEFECTO ES LA DE PERFIL
        // require "views/user/landing.php";
        return;
    }

    public function render($url, $data=[]){
        $view = "views/user/$url.php";
        require $view;
    }

    public function register()
    {
        if ($this->existsPOST(array('email', 'nickname', 'pwd', 'name'))) {
            if ($this->validData($_POST)) {
                $user = new UserModel();
                $user->setAll($_POST);
                $user->setPwd($_POST['pwd']);
                $user->register();
            }
        }
    }

    public function login()
    {
        if ($this->existsPOST(array('email', 'pwd'))) {
            if ($this->validData($_POST)) {
                $user = new UserModel();
                $user->login($_POST['email'], $_POST['pwd']);
            }
        }
    }

    private function isName($name)
    {
        if (!preg_match(constant('REGX_NME'), $name)) {
            echo "Nombre no valido \n";
            return false;
        }

        return true;
    }

    private function isPwd($pwd)
    {
        if (!preg_match(constant('REGX_PWD'), $pwd)) {
            echo "Constrasenia no valida \n";
            return false;
        }

        return true;
    }

    private function isEmail($email)
    {
        if (!preg_match(constant('REGX_EMAIL'), $email)) {
            echo "Correo no valido \n";
            return false;
        }

        return true;
    }

    private function isNickname($nickname)
    {
        if (!preg_match(constant('REGX_NKNAME'), $nickname)) {
            echo "Apodo no valido \n";
            return false;
        }

        return true;
    }

    private function validData($data = [])
    {

        foreach ($data as $key => $d) {
            $valid = "is{$key}";
            if (!$this->{$valid}($d)) {
                return false;
            }
        }

        return true;
    }
}
