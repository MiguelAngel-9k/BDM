<?php

class Controller{

    public function __construct(){
        
    }

    public function existsPOST($keys)
    {
        foreach ($keys as $key) {
            if (!isset($_POST[$key])) {
                return false;
            }
        }

        return true;
    }
    
}

?>