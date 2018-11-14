<?php
    require_once 'config.php';

    final class Conexao{
        private static $instancia;

        public function Open(){
            $instancia = new PDO('mysql:host='.HOST.';dbname='.DB.'',''.USER.'', ''.PASS.'',array(PDO::ATTR_PERSISTENT => true));

            $instancia->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $instancia;
        }
    }



?>