<?php

class Product extends Controller
{

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
                require "views/object/landing.php";
            }
        } else {
            header('location:' . constant('API'));
        }
    }

    public function newProduct()
    {

        $media = [];
        $files = $_FILES['pMedia'];

        // var_dump($files);
        for ($filePosition = 0; $filePosition < (count($files) - 2); $filePosition++) {
            $singleMedia = [
                'name' => $files['name'][$filePosition],
                'type' => explode('/', $files['type'][$filePosition])[0],
                'tmp_name' => $files['tmp_name'][$filePosition],
                'size' => $files['size'][$filePosition],
                'ext' => pathinfo($files['name'][$filePosition], PATHINFO_EXTENSION)
            ];

            if ($singleMedia['type'] == 'video') {
                $time = new DateTime();
                $name = "media/vid{$time->getTimestamp()}{$filePosition}.{$singleMedia['ext']}";
                move_uploaded_file($singleMedia['tmp_name'], $name);
                // echo $name.'<br/>';
                $singleMedia['tmp_name'] = $name;
            }

            array_push($media, $singleMedia);
        }

        // var_dump($media);

        if ($this->existsPOST(['pName', 'pQty', 'pPrice', 'pCat', 'pDesc', 'pOwner'])) {
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

            header('location: ' . constant('API'));
        }
    }

    public function landing()
    {

        session_start();
        if (isset($_SESSION['USER'])) {

            $user = new UserModel();
            $user->get($_SESSION['USER']);
            $categories = new CategoryModel();

            $data = [
                'user' => $user->serialize(),
                'categories' => $categories->getAll()
            ];
            $this->render('', $data);
        }
        header('location:' . constant('API'));
    }

    public function aprove($args = [])
    {
        $product = new ProudctModel();
        $product->updateStatus($args[0]);

        header('location: ' . constant('API'));
    }

    public function preview($args = [])
    {

        session_start();
        $product = new ProudctModel();
        $user = new UserModel();
        $user->get($_SESSION['USER']);
        if (isset($_SESSION['USER'])) {
            $data = [
                'PRODUCT' => $product->get($args[0]),
                'USER' => $user->serialize()
            ];

            $this->render('object/preview', $data);
            return;
        }

        header('location: ' . constant('API'));
    }

    public function product($args = [])
    {
        session_start();
        $product = new ProudctModel();
        $user = new UserModel();
        $list = new WishListModel();
        $user->get($_SESSION['USER']);
        if (isset($_SESSION['USER'])) {
            $data = [
                'PRODUCT' => $product->get($args[0]),
                'USER' => $user->serialize(),
                'WLISTS' => $list->getByOwner($_SESSION['USER'])
            ];

            $this->render('object/product', $data);
            return;
        }
    }

    public function search()
    {
        session_start();
        if ($this->existsPOST(['search'])) {
            $product = new ProudctModel();
            $user = new UserModel();
            $user->get($_SESSION['USER']);


            $data = [
                "products" => $product->lookFor($_POST['search']),
                "user" => $user->serialize()
            ];

            $this->render('object/products', $data);
        }
    }

    public function addToCart($args = [])
    {
        session_start();
        if (isset($_SESSION['USER'])) {
            $product = new ProudctModel();
            echo $product->addCart($_SESSION['USER'], $args[0]);
            header('location:' . constant('API') . 'product/product/' . $args[0]);
        } else {
            header('location:' . constant('API'));
        }
    }

    public function removeFromCart($args = [])
    {
        $product = new ProudctModel();
        $product->deleteCart($args[0], $args[1]);
        header('location:' . constant('API'));
    }

    public function cotizar()
    {
        $json = file_get_contents('php://input');
        $post = json_decode($json, true);
        $product = new ProudctModel();
        $res = $product->cotizar($post['item'], $post['cant'], $post['user']);
        if ($res != null)
            echo json_encode(array(
                'price' => $res['price']
            ));
        else
        echo json_encode(array(
            'price' => 0
        ));
    }

    public function purchase()
    {

        session_start();

        if (isset($_SESSION['USER'])) {
            $user = new UserModel();
            $products = new ProudctModel();
            $user->get($_SESSION['USER']);
            $data = [
                'user' => $user->serialize(),
                'cart' => $products->getCarrito($_SESSION['USER'])
            ];
            $this->render('object/purchase', $data);
        }
    }


    public function pay($args = [])
    {
        $product = new ProudctModel();
        $product->setPayment($args[0], '', 0);
        header('location:'.constant('API'));
    }
}
