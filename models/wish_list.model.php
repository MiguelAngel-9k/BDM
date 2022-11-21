<?php

class Wish_list{

    private $id;
    private $name;
    private $desc;
    private $owner;
    private $image;
    private $priv;


    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connected failed: ' . $e->getMessage());
        }
    }
    function add($name,$desc,$media,$owner,$privacy){
        try{
            $query = $this->conn->prepare("CALL SP_LISTAS(:NAME,:DESC,:IMG,:OWNER,:PRIV,'INS')");
            $query->execute([
                'NAME'=> $name,
                'DESC'=> $desc,
                'IMG'=> $media,
                'OWNER'=> $owner,
                'PRIV'=>$privacy
            ]);
            $prod = $query->fetch(PDO::FETCH_ASSOC)['RESULTADO'];
            $query->closeCursor();


            return $query->rowCount() > 0 ? true : false;

        }catch(PDOException $e) {
            return 'Error al insertar producto ' . $e->getMessage() . "\n";
        }
    }

}
