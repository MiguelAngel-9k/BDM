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

    function add($name, $desc, $cot=false, $price, $qty, $owner, $media){
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

            //NO SE PUEDEN USAR DOS QUERYS A LA VEZ, HACER FUNCION PARA 
            //INSERTAR LAS IMAGENES DE MANERA INDEPENDIENTE 
            //SI ES VIDEO SE GUARDA DE MANERA LOCAL EN EL SERVIDOR
            //SI ES IMAGEN SE GUARDA EN LA BASE DE DATOS COMO BLOB
            $productIserted = $query->fetch(PDO::FETCH_ASSOC)['RESULTADO'];
            $query->closeCursor();
            $mediaQuery = $this->conn->prepare("CALL SP_MULTIMEDIA(0, :PROD, :REC, :EXT, :PESO, :TIPO, 'INS')");
            foreach($media as $resource){
               $mediaQuery->execute([
                    "PROD" => $productIserted,
                    "REC" => file_get_contents($resource[0]['tmp_name']),
                    "EXT" => $resource[0]['ext'],
                    "PESO" => $resource[0]['size'],
                    "TIPO" => $resource[0]['type']
               ]);
               $mediaQuery->fetchAll(PDO::FETCH_ASSOC);
               $mediaQuery->closeCursor();
            }
            

            return $query->rowCount() > 0 ? true : false;
        } catch (PDOException $e) {
            return 'Error al insertar producto ' . $e->getMessage() . "\n";
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