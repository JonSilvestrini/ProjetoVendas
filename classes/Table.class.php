<?php
    class Table extends Element{
        public function __construct(){
            parent::__construct("table");
        }
        public function addRow(){
            // instancia objeto linha
            $row=new TableRow;
            // armazenamento no array de linhas 
            parent::add($row);
            // retorna objeto linha
            return $row;
        }
    }

?>