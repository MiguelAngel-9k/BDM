<?php

class Category extends Controller{
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
                require "views/category/category.php";
            }
        } else {
            header('location:' . constant('API'));
        }
    }


    public function add(){

        session_start();
        if(!isset($_SESSION['USER'])){
            header('location:'.constant('API'));
            return;
        }

        if($this->existsPOST(array('name', 'description', 'owner'))){
            $category = new CategoryModel();
            $category->setAll($_POST);
            $category->create();
            header('location:'.constant('API').'user/profile');
        }

        

        return;
    }

    public function all(){

        session_start();
        if(!isset($_SESSION['USER'])){
            header('location:'.constant('API'));
            return;
        }

        $category = new CategoryModel();
        $category->getAll();
    }

    public function category($args = []){
        session_start();
        $category = new CategoryModel();
        $user = new UserModel();
        $user->get($_SESSION['USER']);
        $data = [
            'user' => $user->serialize(),
            'products' => $category->getProducts($args[0]),
            'categories' => $category->getAll(),
            'idCat' => $args[0]
        ];

        $this->render('', $data);
    }
        
}

?>