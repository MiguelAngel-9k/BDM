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

            array_push($media, $singleMedia);
        }

        // var_dump($media);
        

        /* echo '<ul>';
        $count = 0;
        foreach ($media as $single) {
            echo "<li> Item Numero $count </li>";
            echo "<ul>";
            echo "<li>".$single[0]['name']."</li>";
            echo "<li>".$single[0]['type']."</li>";
            echo "<li>".$single[0]['tmp_name']."</li>";
            echo "<li>".$single[0]['size']."</li>";
            echo "<li>".$single[0]['ext']."</li>";
            echo "</ul>";
            $count++;
        }   
        echo '</ul>'; */

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
                $media
            );

            // header('location: '.constant('API'));

        }
    }

}

//AGREGAR MULTIPLES ARCHVOS MULTIMEDIA
//AGREGAR A COTIZACIONES DE SER NECESARIO
//AGREGAR A LAS CATEGORIAS POR OBJETO



?>