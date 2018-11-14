<?php
class Sessao{
    private $value = array();

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        } 
    }
    public function Add($key, $value){
        $_SESSION[$key]=$value;
    }
    public function Start(){
        foreach ($this->value as $key => $value){
            $_SESSION[$key]=$value;
        }
    }
    public function Close(){
        session_destroy();
        header("Location:index.php");
    }
    public function Protege($email){
        if (!isset($_SESSION[$email])){
            $file = basename($_SERVER['PHP_SELF']);
            header("Location:login.php?path=$file");
        }
    }
}




?>