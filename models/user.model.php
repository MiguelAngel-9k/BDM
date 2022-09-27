<?php

class UserModel{

    private $email;
    private $name;
    private $nickname;
    private $pwd;

    public function __construct(){

    }

    public function setAll($data=[]){
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->nickname = $data['nickname'];
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPwd($pwd){
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
}

?>