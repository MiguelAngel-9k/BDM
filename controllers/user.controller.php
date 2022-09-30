<?php

class User extends Controller
{

    public function __construct()
    {

        parent::__construct();
    }

    public function render($path, $data = [])
    {
        session_start();

        if (isset($_SESSION['USER'])) {
            if (!empty($path)) {
                $url = explode('/', $path);
                $view = "views/$url[0]/$url[1].php";

                if (file_exists($view)) {
                    require "views/$url[0]/$url[1].php";
                }
            } else {
                $this->profile();
            }
        } else {
            if ($_GET['dir'] == '/') {
                require "views/user/register.php";
            } else {
                header('location: http://localhost/');
            }
        }
    }

    public function register()
    {
        session_start();

        if ($this->existsPOST(array('email', 'nickname', 'pwd', 'name'))) {
            if ($this->validData($_POST)) {
                $user = new UserModel();
                $user->setEmail($_POST['email']);
                $user->setNickname($_POST['nickname']);
                $user->setPwd($_POST['pwd']);
                $user->setName($_POST['name']);
                $user->register();
                $_SESSION['USER'] = $user->getEmail();
                header('location: http://localhost/user/profile');
                // $this->render('user/profile', $user->serialize());
            }
        }
    }

    public function profile()
    {
        session_start();
        $user = new UserModel();
        $user->get($_SESSION['USER']);

        $this->render('user/profile',  $user->serialize());
    }

    public function login()
    {
        session_start();

        if ($this->existsPOST(array('email', 'pwd'))) {
            if ($this->validData($_POST)) {
                $user = new UserModel();
                $data = $user->login($_POST['email'], $_POST['pwd']);
                if (!empty($data)) {
                    $_SESSION['USER'] = $user->getEmail();
                    // var_dump($data);
                    header("location: http://localhost/user/profile");
                }
            }
        }
    }

    public function Edit(){
        if($this->existsPOST(array('nickname', 'name', 'email'))){
            if($this->isName($_POST['name']) && $this->isNickname($_POST['nickname'])){
                // $imgData = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
                $user = new UserModel();
                $user->edit($_POST['email'], $_POST['name'], $_POST['nickname'], $_POST['gender']);
                header('location: http://localhost/user/profile');
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
