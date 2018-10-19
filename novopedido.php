<?php

require 'autoload.php';

$con = Conexao::Open();
$vendas = new Registro("pedidos", $con);
$vendas->codped = "0";
$codped = $vendas->save(-1);

header("Location: index.php?codped=$codped");
?>
