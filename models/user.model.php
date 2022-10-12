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
    private $lg;


    public function __construct()
    {

        try {
            $this->conn = new PDO("mysql:host=" . constant('SNAME') . ";dbname=" . constant('DNAME'), constant('UNAME'), constant('PWD'));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connected failed: ' . $e->getMessage());
        }
    }

    public function editPrivacy($user, $mode){

        $privacy = $mode ? 'ON' : 'OFF';

        try {
            $query = $this->conn->prepare("CALL SP_USUARIO(:USUARIO, '', '', '', '', '', :PRIV, 'PRI')");
            $query->execute([
                'USUARIO' => $user,
                'PRIV' => $privacy
            ]);

            if($query->rowCount() > 0){
                return 'Privacy account changed';
            }
        } catch (PDOException $e) {
            return 'Cannot turn edit privacy account, try again: '. $e->getMessage();
        }
    }

    public function setAll($data = [])
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->nickname = $data['nickname'];
    }

    public function get($email)
    {
        try {
            $query = $this->conn->prepare("CALL SP_USUARIO(:email, '', '', '', '', '', '', 'GET')");
            $query->execute([
                'email' => $email
            ]);
            $result = $query->fetch(PDO::FETCH_ASSOC);

            $this->email = $result['CORREO'];
            $this->nickname = $result['APODO'];
            $this->img = $result['IMG'];
            $this->rol = $result['ROL'];
            $this->name = $result['NOMBRE'];
            $this->gender = $result['GENERO'];
            $this->priv = $result['PRIV'];
            $this->lg = $result['LG'];

            /* return array(
                'email' => $this->email,
                'nickname' => $this->nickname,
                'img' => $this->img,
                'rol' => $this->rol,
                'name' => $this->name,
                'gender' => $this->gender,
                'priv' => $this->priv,
                'lg' => $
            ); */
        } catch (PDOException $e) {
            echo 'Error al buscar al usuario ' . $e->getMessage() . "\n";
            return;
        }
    }

    public function changeAvatar($img, $user){
        try {

            $query = $this->conn->prepare("CALL SP_USUARIO(:EMAIL, '', '', :IMG, '', '', '', 'IMG')");
            $query->execute([
                'EMAIL' => $user,
                'IMG' => $img
            ]);

            return true;

        } catch (PDOException $e) {
            return "Algo paso al tratar de cambiar la imagen de avatar, intenta de nuevo, error: ".$e->getMessage();
        }
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
            $query = $this->conn->prepare("CALL SP_SESSION(:email, '', '', '', 'INI')");

            $query->execute([
                'email' => $email
            ]);


            $result = $query->fetch(PDO::FETCH_ASSOC);

            if($query->rowCount() > 0){
                if(password_verify($pwd, $result['PWD'])){
                    $this->email = $result['CORREO'];
                    $this->nickname = $result['APODO'];
                    $this->img = $result['IMGN'];
                    $this->rol = $result['ROL'];
                    $this->name = $result['NOMBRE'];
                    $this->gender = $result['GENERO'];
                    $this->priv = $result['PRIV'];
                    $this->lg = $result['LG'];

                    return array(
                        'email' => $this->email,
                        'nickname' => $this->nickname,
                        'img' => $this->img,
                        'rol' => $this->rol,
                        'name' => $this->name,
                        'gender' => $this->gender,
                        'priv' => $this->priv,
                        'lg' => $this->lg
                    );
                }

                return [];
            }

            return [];


        } catch (PDOException $e) {
            echo 'Error al buscar al usuario ' . $e->getMessage() . "\n";
            return;
        }
    }

    public function register()
    {
        try {
            $query = $this->conn->prepare("CALL SP_SESSION(:EMAIL, :PWD, :NICKNAME, :NAME, 'REG')");
            $query->execute([
                'EMAIL' => $this->email,
                'PWD' => $this->pwd,
                'NICKNAME' => $this->nickname,
                'NAME' => $this->name
            ]);

            //IF USER EMAIL OR USER NICKNAME ALREADY EXISTS ON DB, RETURNS
            //AN ERROR MESSAGE
            if(isset($query->fetch(PDO::FETCH_ASSOC)['RESULTADO']))
                return $query->fetch(PDO::FETCH_ASSOC)['RESULTADO'];

            return null;
        } catch (PDOException $e) {
            echo 'Error al buscar al usuario ' . $e->getMessage() . "\n";
            return 'Ups!!!... Algo ocurrio al crear tu usuario, tendremos a nuestros monos trabajando en ello.';
        }
    }

    public function edit($email, $name, $nickname, $gender){
        try {

            $query = $this->conn->prepare("CALL SP_USUARIO(:email, :nickname, '', '', :name, :gnder, '', 'EDT' )");
            $query->execute([
                'email' => $email,
                'nickname' => $nickname,
                'name' => $name,
                'gnder' => $gender
            ]);
            return;
        } catch (PDOException $e) {
            echo 'Error al buscar al usuario ' . $e->getMessage() . "\n";
            return;
        }
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function serialize()
    {
        return array(
            'email' => $this->email,
            'nickname' => $this->nickname,
            'img' => $this->img,
            'rol' => $this->rol,
            'name' => $this->name,
            'gender' => $this->gender,
            'priv' => $this->priv,
            'lg' => $this->lg
        );
    }
}
