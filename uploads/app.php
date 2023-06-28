<?php
    require_once "../vendor/autoload.php";
    trait getInstance{
        public static $instance;
        public static function getInstance(){
            $arg = func_get_args();
            $arg = array_pop($arg);
            return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
        }
        function __set($name, $value){
            $this->$name = $value;
        }
    }

    $router = new \Bramus\Router\Router();
    $router->get("/", function(){
        echo "SIRVE?";
        campers::getInstance();
    });
    $router->run();
?>