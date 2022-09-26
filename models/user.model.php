<?php

class UserModel{

    private $email;
    private $nickname;
    private $pwd;
    private $name;
    
    public function __construct(){
        
    }

    public function setAll($data = []){

        $this->email = $data['email'];
        $this->nickname = $data['nickname'];
        $this->pwd = $data['pwd'];
        $this->name = $data['name'];

        return;

    }

}

?>