<?php

class ProudctModel
{

    private $id;
    private $cover;
    private $name;
    private $description;
    private $contization = false;
    private $price;
    private $quantity;
    private $owner;
    private $category;
    private $date;
    private $media = [];
    private $cart;
    public $medType;
    public $medExt;

    private $conn;

    function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connected failed: ' . $e->getMessage());
        }
    }

    function get($obj)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_OBJETOS(:OBJ, '', '', 0, 0, 0, '', 0, 'GET')");
            $sql->execute([
                "OBJ" => $obj
            ]);

            if ($sql->rowCount() < 0)
                return "No se encontro producto con ese id";

            $buffer = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                array_push($buffer, $row);
                $media = array(
                    'resource' => $row['RECURSO'],
                    'ext' => $row['EXTENSION'],
                    'type' => $row['TIPO']
                );
                array_push($this->media, $media);
            }

            $this->setID($buffer[0]['ID_OBJ']);
            $this->setName($buffer[0]['OBJETO']);
            $this->setQuantity($buffer[0]['STOCK']);
            $this->setOwner($buffer[0]['VENDEDOR']);
            $this->setPrice($buffer[0]['PRECIO']);
            $this->setDescription($buffer[0]['DESCRIPCION']);

            return $this->serialize();
        } catch (PDOException $e) {
            return 'Error al obtener el objeto' . $e->getMessage();
        }
    }

    function add($name, $desc, $cot, $price, $qty, $owner, $media, $category)
    {
        try {
            $query = $this->conn->prepare("CALL SP_OBJETOS(0, :NAME, :DESC, :COT, :PRICE, :QTY, :OWNER, :CAT, 'INI')");
            $query->execute([
                'NAME' => $name,
                'DESC' => $desc,
                'COT' => $cot ? 1 : 0,
                'PRICE' => $price,
                'QTY' => $qty,
                'OWNER' => $owner,
                'CAT' => $category
            ]);

            $prod = $query->fetch(PDO::FETCH_ASSOC)['RESULTADO'];
            $query->closeCursor();
            if ($this->setMedia($media, $prod) == null) return 'No se agrego la imagen';


            return $query->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            return 'Error al insertar producto ' . $e->getMessage() . "\n";
        }
    }

    function getByOwner($owner)
    {
        try {
            $query = $this->conn->prepare("CALL SP_OBJETOS(0, '', '', 0, 0, 0, :OWNER, 0, 'GTO')");
            $query->execute(['OWNER' => $owner]);

            $buffer = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {

                if (isset($buffer[$row['OBJETO']]))
                    continue;

                $product = new ProudctModel();
                $product->setName($row['TITULO']);
                $product->setCover($row['PORTADA']);
                $product->setDescription($row['DESCRIPCION']);
                $product->setPrice($row['PRECIO']);
                $product->setID($row['OBJETO']);
                $product->setOwner($row['VENDEDOR']);
                $product->medType = $row['TIPO'];
                $product->medExt = $row['EXTENSION'];

                $buffer[$row['OBJETO']] = $product;
            }

            return $buffer;
        } catch (PDOException $e) {
            return 'Error al obtener los productos por usuario ' . $e->getMessage() . "\n";
        }
    }

    private function setMedia($media, $prod)
    {
        $query = $this->conn->prepare("CALL SP_MULTIMEDIA(0, :PROD, :REC, :EXT, :PESO, :TIPO, 'INS')");
        foreach ($media as $resource) {
            if (!$resource) break;

            try {
                $query->execute([
                    "PROD" => $prod,
                    "REC" => file_get_contents($resource['tmp_name']),
                    "EXT" => $resource['ext'],
                    "PESO" => $resource['size'],
                    "TIPO" => $resource['type']
                ]);
                $query->closeCursor();
            } catch (PDOException $e) {
                echo 'Error al insertar las imagenes del producto' . $e->getMessage();
                return null;
            }
        }
    }

    function getRequests()
    {
        try {
            $sql = $this->conn->prepare("CALL SP_SOLICITUDES(0, '', 'ALL')");
            $sql->execute();

            $requests = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                if (isset($requests[$row['ID_OBJETO']]))
                    continue;

                $request = new ProudctModel();
                $request->setID($row['ID_OBJETO']);
                $request->setName($row['OBJETO']);
                $request->setCategory($row['CATEGORIA']);
                $request->setOwner($row['VENDEDOR']);
                $request->setDate($row['ALTA']);
                $request->setQuantity($row['CANTIDAD']);
                $request->setPrice($row['PRECIO']);

                $requests[$row['ID_OBJETO']] = $request;
            }

            return $requests;
        } catch (PDOException $e) {
            echo 'Error al traer las solicitudes de objetos';
            return 'Error al traer las solicitudes de objetos'.$e->getMessage();
        }
    }

    function updateStatus($obj)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_SOLICITUDES(:OBJ, '', 'APR')");
            $sql->execute([
                'OBJ' => $obj
            ]);

            $buffer = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $request = new ProudctModel();
                $request->setID($row['ID_OBJETO']);
                $request->setName($row['OBJETO']);
                $request->setCategory($row['CATEGORIA']);
                $request->setOwner($row['VENDEDOR']);
                $request->setDate($row['ALTA']);
                $request->setQuantity($row['CANTIDAD']);
                $request->setPrice($row['PRECIO']);

                array_push($buffer, $request);
            }

            return $buffer;
        } catch (PDOException $e) {
            echo 'Error al aprovar el objeto';
            return;
        }
    }

    public function lookFor($desc)
    {
        try {

            $sql = $this->conn->prepare("CALL SP_OBJETOS(0, '', :DESC, 0, 0, 0, '', 0, 'BUS')");
            $sql->execute(["DESC" => $desc]);


            $products = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                if (isset($products[$row['OBJETO']]))
                    continue;

                $product = new ProudctModel();
                $product->setName($row['TITULO']);
                $product->setCover($row['PORTADA']);
                $product->setDescription($row['DESCRIPCION']);
                $product->setPrice($row['PRECIO']);
                $product->setID($row['OBJETO']);
                $product->setOwner($row['VENDEDOR']);
                $product->medType = $row['TIPO'];
                $product->medExt = $row['EXTENSION'];

                $products[$row['OBJETO']] = $product;
            }

            return $products;
        } catch (PDOException $e) {
            echo 'Cannot look for an objet: ' . $e->getMessage();
            return;
        }
    }

    public function addCart($usr, $item)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_CARRITO(0, :USR, :OBJ, 0, 'INS')");
            $sql->execute([
                "USR" => $usr,
                "OBJ" => $item
            ]);

            if ($sql->rowCount() > 0)
                return true;

            return false;
        } catch (PDOException $e) {
            echo 'Cannot add item to cart: ' . $e->getMessage();
            return;
        }
    }

    public function getCarrito($usr)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_CARRITO(0, :USR, 0, 0, 'GET')");
            $sql->execute(["USR" => $usr]);

            $products = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $product = new ProudctModel();
                $product->setOwner($row['USUARIO']);
                $product->setID($row['OBJETO']);
                $product->setCart($row['CARRITO']);
                $product->setName($row['NOMBRE']);
                $product->setCategory($row['CATEGORIA']);
                $product->setPrice($row['PRECIO']);
                $product->setDate($row['FECHA']);
                $product->setQuantity($row['CANTIDAD']);

                array_push($products, $product);
            }

            return $products;
        } catch (PDOException $e) {
            echo 'Cannot get cart: ' . $e->getMessage();
            return;
        }
    }

    public function deleteCart($cart, $item)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_CARRITO(:CART, '', :ITEM, 0, 'ELI')");
            $sql->execute(["CART" => $cart, "ITEM" => $item]);

            if ($sql->rowCount() > 0)
                return true;

            return false;
        } catch (PDOException $e) {
            echo 'Cannot delete item from cart: ' . $e->getMessage();
            return;
        }
    }

    public function cotizar($item, $cantidad, $user)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_COTIZACIONES(:USER, :OBJ, :CANT)");
            $sql->execute([
                "USER" => $user,
                "OBJ" => $item,
                "CANT" => $cantidad
            ]);

            if ($sql->rowCount() > 0) {
                $res = $sql->fetch(PDO::FETCH_ASSOC);

                if (isset($row['none']))
                    return null;

                $product = new ProudctModel();
                $product->setOwner($res['USUARIO']);
                $product->setID($res['OBJ']);
                $product->setQuantity($res['CANTIDAD']);
                $product->setPrice($res['PORCENTAJE']);

                return $product->serialize();
            }

            return null;
        } catch (PDOException $e) {
            echo 'Cannot cotizar item: ' . $e->getMessage();
            return;
        }
    }

    function serialize()
    {
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "desc" => $this->description,
            "cot" => $this->contization,
            "price" => $this->price,
            "qty" => $this->quantity,
            "owner" => $this->owner,
            "cat" => $this->cat,
            "date" => $this->date,
            "media" => $this->media
        );
    }

    public function setPayment($user, $comment, $rate)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_VENTA(:COMMENT, :CALIF, :USUARIO)");
            $sql->execute([
                "COMMENT" => $comment,
                "CALIF" => $rate,
                "USUARIO" => $user
            ]);

            return true;
        } catch (PDOException $e) {
            echo 'Cannot pay: ' . $e->getMessage();
            return;
        }
    }

    public function sales($user)
    {
        try {
            $sql = $this->conn->prepare("SELECT FECHA_VENTA, CATEGORIA, PRODUCTO, PRECIO, EXISTENCIA, VENDEDOR FROM REPORTE_VENTA_DETALLE WHERE VENDEDOR = :USER");
            $sql->execute(["USER" => $user]);


            $sales = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $sale = new ProudctModel();
                $sale->setDate($row['FECHA_VENTA']);
                $sale->setCategory($row['CATEGORIA']);
                $sale->setName($row['PRODUCTO']);
                $sale->setPrice($row['PRECIO']);
                $sale->setQuantity($row['EXISTENCIA']);
                $sale->setOwner($row['VENDEDOR']);

                array_push($sales, $sale);
            }

            return $sales;
        } catch (PDOException $e) {
            echo 'Cannot get sales report: ' . $e->getMessage();
            return;
        }
    }/* 

    public function purchases($user){
        try {
            $sql = $this->conn->prepare("SELECT ID_VENTA, ID_OBJ, VEN_CANT, PRECIO FROM VENTAS_DETALLE WHERE ");
            $sql->execute(["USER" => $user]);


            $sales = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                $sale = new ProudctModel();
                $sale->setDate($row['FECHA_VENTA']);
                $sale->setCategory($row['CATEGORIA']);
                $sale->setName($row['PRODUCTO']);
                $sale->setPrice($row['PRECIO']);
                $sale->setQuantity($row['EXISTENCIA']);
                $sale->setOwner($row['VENDEDOR']);

                array_push($sales, $sale);
            }

            return $sales;
        } catch (PDOException $e) {
            echo 'Cannot get sales report: ' . $e->getMessage();
            return;
        }
    } */


    //SETTERS
    function setID($id)
    {
        $this->id = $id;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setDescription($desc)
    {
        $this->description = $desc;
    }
    function setCotization($cot)
    {
        $this->contization = $cot;
    }
    function setPrice($price)
    {
        $this->price = $price;
    }
    function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    function setOwner($owner)
    {
        $this->owner = $owner;
    }
    function setCover($cover)
    {
        $this->cover = $cover;
    }
    function setCategory($category)
    {
        $this->category = $category;
    }
    function setDate($date)
    {
        $this->date = $date;
    }
    function setCart($cart)
    {
        $this->cart = $cart;
    }

    //GETTERS
    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getDescription()
    {
        return $this->description;
    }
    function getCotization()
    {
        return $this->contization;
    }
    function getPrice()
    {
        return $this->price;
    }
    function getQuantity()
    {
        return $this->quantity;
    }
    function getOwner()
    {
        return $this->owner;
    }
    function getCover()
    {
        return $this->cover;
    }
    function getCategory()
    {
        return $this->category;
    }
    function getDate()
    {
        return $this->date;
    }
    function getCart()
    {
        return $this->cart;
    }
}
