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
        $files = $_FILES['pMedia'];


        for ($filePosition=0; $filePosition < (count($files) - 2) ; $filePosition++) { 
            $singleMedia = array([
                'name' => $files['name'][$filePosition],
                'type' => explode( '/',$files['type'][$filePosition])[0],
                'tmp_name' => $files['tmp_name'][$filePosition],
                'size' => $files['size'][$filePosition],
                'ext' => pathinfo($files['name'][$filePosition], PATHINFO_EXTENSION)
            ]);

            if($singleMedia['type'] === 'video'){
                move_uploaded_file($singleMedia['tmp_name'], '/');
                $singleMedia['name'] = '/';
            }

            array_push($media, $singleMedia);
        }

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

    public function landing(){

        session_start();
        if(isset($_SESSION['USER'])){

            $user = new UserModel();
            $user->get($_SESSION['USER']);
            $categories = new CategoryModel();

            $data = [
                'user' => $user->serialize(),
                'categories' => $categories->getAll()
            ];
            $this->render('', $data);
        }
        header('location:'.constant('API'));
    }

}



?>