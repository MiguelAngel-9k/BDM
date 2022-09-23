<?php

class App{

    private static $app = null;
    public static $counter = 0;

    private function __construct(){
        App::$counter++;
        echo "Constructor de App \n Veces construida: ".App::$counter;
    }

    public static function Init_one(){

        if(App::$app == null)
            App::$app = new App();

        return App::$app;

    }

}

?>