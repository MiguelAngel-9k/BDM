<?php

class WishListModel extends Model{
    function __construct(){
        parent::__construct();
    }

    private $id;
    private $name;
    private $cover;
    private $owner;
    private $date;
    private $privacy;
    private $desc;


    public function add($name, $cover, $owner, $desc){
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(0, :NAME, :DESC, :COVER, :OWNER, '', 'ADD')");
            $sql->execute([
                "NAME" => $name,
                "DESC" => $desc,
                "OWNER" => $owner,
                "COVER" => $cover
            ]);

            if($sql->rowCount() < 0)
                return 'Canno create a new wish list';

            $row = $sql->fetch(PDO::FETCH_ASSOC);

            return $row;

        } catch (PDOException $e) {
            return 'Canno create a new wish list: ' . $e->getMessage();
        }
    }

    public function getByOwner($owner){
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(0, '', '', '', :OWNER, '', 'GET')");
            $sql->execute(["OWNER" => $owner]);

            $lists = [];
            while($row = $sql->fetch(PDO::FETCH_ASSOC)){
                $list = new WishListModel();
                $list->setCover($row['DL_IMGN']);
                $list->setID($row['ID_LISTA']);
                $list->setName($row['DL_NOMBRE']);
                $list->setDescription($row['DL_DESC']);
                $list->setOwner($row['DL_USR']);
                $list->setDate($row['DL_ALTA']);
                $list->setPrivacy($row['DL_PRIV']);

                $lists[$row['ID_LISTA']] = $list;
            }

            return $lists;

        } catch (PDOException $e) {
            return 'Cannot get lists: ' . $e->getMessage();
        }
    }

    function setID($id){ $this->id = $id;}
    function setName($name){ $this->name = $name;}   
    function setCover($cover){ $this->cover = $cover;}
    function setOwner($owner){ $this->owner = $owner;}   
    function setDate($date) { $this->date = $date;}
    function setPrivacy($privacy) { $this->privacy = $privacy;}    
    function setDescription($description){ $this->desc= $description; }

    function getID(){ return $this->id;}    
    function getName(){ return $this->name;}
    function getCover(){ return $this->cover;}
    function getOwner(){ return $this->owner;}
    function getDate(){ return $this->date;}
    function getPrivacy(){ return $this->privacy;}
    function getDescription(){ return $this->desc; }
}
