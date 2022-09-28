<?php

class Controller
{

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['USER'])){
                $this->render('user/register');
            // header('location: http://10.52.2.61/user/register');
        }
    }

    private function render($path, $data = [])
    {

        if (!empty($path)) {
            $url = explode('/', $path);
            $view = "views/$url[0]/$url[1].php";

            if (file_exists($view)) {
                require "views/$url[0]/$url[1].php";
            }
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
