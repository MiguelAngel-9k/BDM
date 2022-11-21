<?php

class WishList extends Controller{
    function __construct(){
        parent::__construct();
    }


    public function new(){
        
        if($this->existsPOST(['owner', 'wName', 'wDescription'])){
                $imgData = !empty($_FILES) 
                    ? file_get_contents($_FILES['wCover']['tmp_name'])
                    : file_get_contents('../assets/img/customer_bg_card.jpg');
                $wishlist = new WishListModel();
                $wishlist->add(
                    $_POST['wName'],
                    $imgData,
                    $_POST['owner'],
                    $_POST['wDescription']
                );
            }
            //imagen por defcto por si no agrega una imagen

        header('location'.constant('API'));
    }
}
