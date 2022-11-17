<?php

class Product extends Controller{

    public function __construct(){
        parent:: __construct();
    }

   /*  public function render(){
        $view = 'views/object/landing.php';
        if(file_exists($view)){
            require $view;
        }
    }

    public function render($path, $data=[]){
        echo 'product controller render';
    } */

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

}



?>