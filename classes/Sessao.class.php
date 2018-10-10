<?php

#### Sessao.class.php ####


class Sessao {
    //array que receberá os valores para mostrar no template
    private $values = array();

    //método construtor que recebe o arquivo template
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE){
            session_start();
        }
    }

    //método que recebe a chave e os valores para a sessão
    public function Add($key, $value) {
        $_SESSION[$key]=$value;
    }

    //método para mostrar o conteúdo do array values no template selecionado
    public function Start(){
        //loop que varre o array e substitui as chaves do template pelos valores do array
        foreach ($this->values as $key => $value){
            $_SESSION[$key]=$value;
        }
    }

    public function Close(){
        session_destroy();
        header("Location: index.php");
    }

    public function Protege($email){
        if (!isset($_SESSION[$email])){
            $file = basename($_SERVER['PHP_SELF']);
            header("Location:login.php?path=$file");
        }
    }
}
?>