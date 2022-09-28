<?php

class UserModel
{

    private $email;
    private $name;
    private $nickname;
    private $pwd;
    private $img;
    private $rol;
    private $priv;
    private $gender;
    private $conn;


    public function __construct()
    {

        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connected successfully';
        } catch (PDOException $e) {
            echo 'Connected failed: ' . $e->getMessage();
        }
    }

    public function setAll($data = [])
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->nickname = $data['nickname'];
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPwd($pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function login($email, $pwd)
    {

        try {
            $query = $this->conn->prepare( "CALL SP_SESSION(:email, :pwd, '', '', 'INI')");

            $query->execute([
                'email' => $email,
                'pwd' => $pwd
            ]);


            $result = $query->fetch(PDO::FETCH_ASSOC);

            $this->email = $result['CORREO'];
            $this->nickname = $result['APODO'];
            $this->img = $result['IMGN'];
            $this->rol = $result['ROL'];
            $this->name = $result['NOMBRE'];
            $this->gender = $result['GENERO'];
            $this->priv =$result['PRIV'];

            return array(
                'email' => $this->email,
                'nickname' => $this->nickname,
                'img' => $this->img,
                'rol' => $this->rol,
                'name' => $this->name,
                'gender' => $this->gender,
                'priv' => $this->priv
            );

        } catch (PDOException $e) {
            echo 'Error al buscar al usuario '.$e->getMessage()."\n";
            return;
        }
    }

    public function register()
    {
        echo 'REGISTER NEW ACCOUNT';
        //USE SP SESSION ON DATABAS WITH OPTION LOGIN
    }
}
