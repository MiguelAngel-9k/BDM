<?php

class Category extends Controller{
    public function __construct()
    {
        parent::__construct();
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
}

?>