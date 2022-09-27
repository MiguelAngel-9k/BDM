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

    public function login($email, $pwd){
        echo "LOGED IN \n";
        //USE SP SESSION ON DATABASE WITH OPTION REGISTER
    }

    public function register(){
        echo 'REGISTER NEW ACCOUNT';
        //USE SP SESSION ON DATABAS WITH OPTION LOGIN
    }

}

?>