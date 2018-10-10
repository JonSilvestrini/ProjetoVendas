<?php

### autentica.php ###

require "autoload.php";

$path = isset($_POST['path'])?$_POST['path']:'index.php';

if ($_POST['email']==""){
    header("Location: login.php?erro=vazio&campo=Email");
    exit;
}

if ($_POST['senha']==""){
    header("Location: login.php?erro=vazio&campo=Senha&email=$_POST[email]");
    exit;
}

$senha=sha1($_POST['senha']);
$con=Conexao::Open();
$usuario=new Registro("usuarios", $con);
$row=$usuario->findCriterio("*","where email='$_POST[email]' and senha='$senha'");

foreach($row as $arr=>$linha){
    $codigo = $linha['codigo'];
    $nome = $linha['nome'];
    $email = $linha['email'];
}
//echo "davi $nome";exit;
if ($email){
    $sessao=new Sessao();
    $sessao->Add("codigo",$codigo);
    $sessao->Add("nome",$nome);
    $sessao->Add("email",$email);

    header("Location:$path");
}else{
    header("Location: login.php?erro=invalido&campo=Senha");
    exit;
}

?>