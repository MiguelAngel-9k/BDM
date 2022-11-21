<?php

class Product extends Controller{

    public function __construct(){
        parent:: __construct();
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
                require "views/object/landing.php";
            }
        } else {
            header('location:' . constant('API'));
        }
    }

    public function newProduct(){

        $media = [];

        if($this->existsPOST(['pName', 'pQty', 'pPrice', 'pCat', 'pDesc', 'pOwner'])){
            $product = new ProudctModel();
            $cot = isset($_POST['pCot']);
            echo $product->add(
                $_POST['pName'],
                $_POST['pDesc'],
                $cot,
                $_POST['pPrice'],
                $_POST['pQty'],
                $_POST['pOwner'],
                $media,
                $_POST['pCat']
            );

            header('location: '.constant('API'));

        }
    }
    public function newList(){
        $user = new UserModel();
            $user->get($_SESSION['USER']);
            $categories = new CategoryModel();
            $productt = new ProudctModel();
            $data = [
                'user' => $user->serialize(),
                'categories' => $categories->getAll(),
               'productos'=> $productt->getAll(),
            ];
        if($this->existsPOST(['NameList', 'descripcion','owner'])){
            $List = new  Wish_list();
            echo $List->add(
                $_POST['NameList'],
                $_POST['descripcion'],
               file_get_contents($_FILES['pMedia']['tmp_name']),
                $_POST['owner'],
                $_POST['privacy']
            );

            $this->render('whis_list/whis_list', $data);

        }else{
            header('location: '.constant('API'));
        }
    }
    public function landing(){

        session_start();
        if(isset($_SESSION['USER'])){

            $user = new UserModel();
            $user->get($_SESSION['USER']);
            $categories = new CategoryModel();
            $productt = new ProudctModel();
            $data = [
                'user' => $user->serialize(),
                'categories' => $categories->getAll(),
               'productos'=> $productt->getAll(),
            ];
            $this->render('', $data);
        }
        header('location:'.constant('API'));
    }
    
    public function aprove($args= []){
        $product = new ProudctModel();
        $product->updateStatus($args[0]);

        header('location: '.constant('API'));
    }
    public function whis_list(){
        session_start();
        if(isset($_SESSION['USER'])){

            $user = new UserModel();
            $user->get($_SESSION['USER']);
            $categories = new CategoryModel();
            $productt = new ProudctModel();
            $data = [
                'user' => $user->serialize(),
                'categories' => $categories->getAll(),
               'productos'=> $productt->getAll(),
            ];
            $this->render('whis_list/whis_list', $data);
        }
        header('location:'.constant('API'));
    }

    public function preview($args = []){

        session_start();
        $product = new ProudctModel();
        $user = new UserModel();
        $user->get($_SESSION['USER']);
        if(isset($_SESSION['USER'])){
            $data = [
                'PRODUCT' => $product->get($args[0]),
                'USER' => $user->serialize()
            ];

            $this->render('object/preview', $data);
            return;
        }

        header('location: '.constant('API'));
    }

}



?>