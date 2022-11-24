<?php

class WishListModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    private $id;
    private $name;
    private $cover;
    private $owner;
    private $date;
    private $privacy;
    private $desc;
    public $ext;
    public $type;


    public function add($name, $cover, $owner, $desc, $privacy)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(0, :NAME, :DESC, :COVER, :OWNER, :PRIV, 0, 'ADD')");
            $sql->execute([
                "NAME" => $name,
                "DESC" => $desc,
                "OWNER" => $owner,
                "COVER" => $cover,
                "PRIV" => $privacy
            ]);

            if ($sql->rowCount() < 0)
                return 'Canno create a new wish list';

            $row = $sql->fetch(PDO::FETCH_ASSOC);

            return $row;
        } catch (PDOException $e) {
            return 'Canno create a new wish list: ' . $e->getMessage();
        }
    }

    public function getByOwner($owner)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(0, '', '', '', :OWNER, '', 0,'GET')");
            $sql->execute(["OWNER" => $owner]);

            $lists = [];
            while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
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

    public function addItem($list, $item)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', '', :ITEM, 'ADI')");
            $sql->execute([
                "LIST" => $list,
                "ITEM" => $item
            ]);

            if ($sql->rowCount() > 1)
                return true;

            return false;
        } catch (PDOException $e) {
            return 'Cannot add element to list: ' . $e->getMessage();
        }
    }

    public function getList($list)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', '', 0, 'GEL')");
            $sql->execute([
                "LIST" => $list
            ]);

            if ($sql->rowCount() > 0) {
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $list = new WishListModel();
                $list->setID($row['LISTA']);
                $list->setPrivacy($row['PRIVACIDAD']);
                $list->setName($row['NOMBRE']);
                $list->setOwner($row['AUTOR']);
                $list->setDescription($row['DESCRIPCION']);
                $list->setCover($row['PORTADA']);
                $list->type = $row['TIPO'];
                $list->ext = $row['EXTENSION'];

                return $list->serialize();
            }

            return null;
        } catch (PDOException $e) {
            return 'Cannot get list: ' . $e->getMessage();
        }
    }

    public function getListItems($list)
    {
        try {
            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', '', 0, 'LIS')");
            $sql->execute([
                "LIST" => $list
            ]);

            $products = [];
            while($row = $sql->fetch(PDO::FETCH_ASSOC)){

                if(isset($products[$row['OBJETO']]))
                    continue;


                $product = new ProudctModel();
                $product->setName($row['TITULO']);
                $product->setPrice($row['PRECIO']);
                $product->setCover($row['PORTADA']);
                $product->setID($row['OBJETO']);

                $products[$row['OBJETO']] = $product;

            }

            return $products;

        } catch (PDOException $e) {
            return 'Cannot get items list: ' . $e->getMessage();
        }
    }

    public function deleteItem($list, $item){
        try{

            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', '', :ITEM, 'ELI')");
            $sql->execute([
                'LIST' => $list,
                'ITEM' => $item
            ]);

            if($sql->rowCount() > 0)
                return true;

            return false;

        } catch (PDOException $e) {
            return 'Cannot delete item list: ' . $e->getMessage();
        }
    }

    public function deleteList($list){
        try{
            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', '', 0, 'ELL')");
            $sql->execute(['LIST' => $list]);

            if($sql->rowCount() > 0)
                return true;

            return false;
        }catch (PDOException $e) {
            return 'Cannot delete list: ' . $e->getMessage();
        }
    }


    public function serialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cover' => $this->cover,
            'owner' => $this->owner,
            'date' => $this->date,
            'privacy' => $this->privacy,
            'description' => $this->desc
        ];
    }

    public function updatePrivacy($list, $priv){
        try{
            $sql = $this->conn->prepare("CALL SP_WISHLIST(:LIST, '', '', '', '', :PRIV, 0, 'PRV')");
        $sql->execute([
            "LIST" => $list,
            "PRIV" => $priv
        ]);

        if($sql->rowCount() > 0)
            return true;

        return false;
        }catch (PDOException $e) {
            return 'Cannot update privacy: ' . $e->getMessage();
        }
    }


    function setID($id)
    {
        $this->id = $id;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setCover($cover)
    {
        $this->cover = $cover;
    }
    function setOwner($owner)
    {
        $this->owner = $owner;
    }
    function setDate($date)
    {
        $this->date = $date;
    }
    function setPrivacy($privacy)
    {
        $this->privacy = $privacy;
    }
    function setDescription($description)
    {
        $this->desc = $description;
    }

    function getID()
    {
        return $this->id;
    }
    function getName()
    {
        return $this->name;
    }
    function getCover()
    {
        return $this->cover;
    }
    function getOwner()
    {
        return $this->owner;
    }
    function getDate()
    {
        return $this->date;
    }
    function getPrivacy()
    {
        return $this->privacy;
    }
    function getDescription()
    {
        return $this->desc;
    }
}
