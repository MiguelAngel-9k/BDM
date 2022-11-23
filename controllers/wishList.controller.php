<?php

class WishList extends Controller
{
    function __construct()
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
                require "views/wishlist/wishlist.php";
            }
        } else {
            header('location:' . constant('API'));
        }
    }


    public function new()
    {

        if ($this->existsPOST(['owner', 'wName', 'wDescription'])) {
            $imgData = !empty($_FILES)
                ? file_get_contents($_FILES['wCover']['tmp_name'])
                : file_get_contents('../assets/img/customer_bg_card.jpg');
            $wishlist = new WishListModel();
            $wishlist->add(
                $_POST['wName'],
                $imgData,
                $_POST['owner'],
                $_POST['wDescription'],
                isset($_POST['wPrivate']) ? 'On' : 'Off'
            );
        }
        //imagen por defcto por si no agrega una imagen

        header('location: ' . constant('API'));
    }

    public function addProduct()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        if (isset($post['list']) && isset($post['obj'])) {
            $wishlist = new WishListModel();
            if ($wishlist->addItem($post['list'], $post['obj'])) {
                echo json_encode(array(['res' => 'Added successfull']));
            } else {
                echo json_encode(array(['res' => 'Add failed']));
            }
        } else {
            echo json_encode(array('res' => 'Something missing'));
        }
    }

    public function list($args = [])
    {
        session_start();

        $list = new WishListModel();
        $user = new UserModel();
        $user->get($_SESSION['USER']);
        $data = [
            'list' => $list->getList($args[0]),
            'lists' => $list->getByOwner($_SESSION['USER']),
            'user' => $user->serialize(),
            'items' => $list->getListItems($args[0])
        ];
        $this->render('', $data);
    }

    public function removeItem($args = []){

        $list = new WishListModel();
        $list->deleteItem($args[1], $args[0]);
        header('location:'.constant('API').'/wishList/list/'.$args[1]);

    }

    public function removeList($args = []){
        
        $list = new WishListModel();
        $list->deleteList($args[0]);
        header('location:'.constant('API'));

    }

    public function privacy($args = []){
        $list = new WishListModel();

        $priv = $args[1] === 'Public List'
            ? 'Off'
            : 'On';

        $list->updatePrivacy($args[0], $priv);

        header('location: '.constant('API').'wishList/list/'.$args[0]);
    }
}
