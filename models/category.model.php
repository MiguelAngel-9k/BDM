<?php

class CategoryModel{

    private $id;
    private $name;
    private $desc;
    private $owner;

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

    public function getAll(){
        $buffer = [];

        try {
            $query = $this->conn->prepare("CALL SP_CATEGORIAS(0, '', '', '', 'ALL')");
            $query->execute();

            while($row = $query->fetch(PDO::FETCH_ASSOC)){

                $category = new CategoryModel();
                $category->setAll($row);

                array_push($buffer, $category->serialize());

            }

            return $buffer;

        } catch (PDOException $e) {
            die('Cannot get categoires, somethin went wrong, try again code error: ' . $e->getMessage());
        }
    }

    public function create(){
        try {
            $query = $this->conn->prepare("CALL SP_CATEGORIAS(0, :NAME, :DESC, :USR, 'INS')");
            $query->execute([
                'NAME' => $this->name,
                'DESC' => $this->desc,
                'USR' => $this->owner
            ]);
            
            return;
        } catch (PDOException $e) {
            echo 'Error al insertar la categoria ' . $e->getMessage() . "\n";
            return;
        }
    }

    public function setAll($data=[]){
        foreach($data as $dkey => $dvalue){
            $function = "set{$dkey}"; 
            if(method_exists($this, $function)){
                $this->{$function}($dvalue);
            }else{
                echo 'Method: '.$function.' No exists';
            }
        }
    }

    public function serialize(){
        return array(
            'ID' => $this->id,
            'NAME' => $this->name,
            'DESCRIPTION' => $this->desc,
            'OWNER' => $this->owner
        );
    }

    /* GETTERS */
    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->desc;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function getId(){
        return $this->id;
    }

    /* SETTERS */
    public function setName($name){
        $this->name = $name;
    }

    public function setDescription($desc){
        $this->desc = $desc;
    }

    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function setID($id){
        $this->id = $id;
    }
}
