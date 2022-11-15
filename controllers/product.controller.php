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
        if($this->existsPOST(['pName', 'pQty', 'pPrice', 'pCat', 'pDesc', 'pOwner'])){
            $product = new ProudctModel();
            $cot = isset($_POST['pCot']);
            $product->add(
                $_POST['pName'],
                $_POST['pDesc'],
                $cot,
                $_POST['pPrice'],
                $_POST['pQty'],
                $_POST['pOwner']
            );

            header('location: '.constant('API'));

        }
    }

}

//AGREGAR MULTIPLES ARCHVOS MULTIMEDIA
//AGREGAR A COTIZACIONES DE SER NECESARIO
//AGREGAR A LAS CATEGORIAS POR OBJETO



?>