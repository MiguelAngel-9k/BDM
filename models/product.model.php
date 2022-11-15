<?php

class ProudctModel{
    
    private $id;
    private $name;
    private $description;
    private $contization = false;
    private $price;
    private $quantity;
    private $owner;

    private $conn;

    function __construct(){
        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connected failed: ' . $e->getMessage());
        }
    }

    function add($name, $desc, $cot=false, $price, $qty, $owner){
        try {
            $query = $this->conn->prepare("CALL SP_OBJETOS(0, :NAME, :DESC, :COT, :PRICE, :QTY, :OWNER, 'INI')");
            $query->execute([
                'NAME' => $name,
                'DESC' => $desc,
                'COT' => $cot ? 1 : 0,
                'PRICE' => $price, 
                'QTY' => $qty,
                'OWNER' => $owner
            ]);

            return $query->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            echo 'Error al buscar al usuario ' . $e->getMessage() . "\n";
            return 'Ups!!!... Algo ocurrio al crear un nuevo producto.';
        }
    }

    //SETTERS
    function setID($id){ $this->id = $id; }
    function setName($name){ $this->name = $name; }
    function setDescription($desc){ $this->description = $desc; }
    function setCotization($cot){ $this->contization = $cot; }
    function setPrice($price){ $this->price = $price; }
    function setQuantity($quantity){ $this->quantity = $quantity; }
    function setOwner($owner){ $this->owner = $owner; }

    //GETTERS
    function getID(){ return $this->id; }
    function getName(){ return $this->name; }
    function getDescription(){ return $this->description; }
    function getCotization(){ return $this->contization; }
    function getPrice(){ return $this->price; }
    function getQuantity(){ return $this->quantity; }
    function getOwner(){ return $this->owner; }

}

?>