<?php
    require "autoload.php";

    
    $path = isset($_POST['path'])?$_POST['path']:"index.php";

    if ($_POST['login']==""){
        header("Location: login.php?erro=vazio&campo=Login");
        exit;
    }
    if($_POST['senha']==""){
    header("Location: login.php?erro=vazio&campo=Senha&email=$_POST[login]");
    exit;
    }
    $senha=sha1($_POST['senha']);
    $con=Conexao::Open();
    $usuario=new Registro("usuarios",$con);
    $row=$usuario->findCriterio("*","where usulogin='$_POST[login]' and ususenha='$senha'");

    foreach($row as $arr=>$linha){
    $codigo = $linha['usucodigo'];
    $nome = $linha['usunome'];
    $email = $linha['usulogin'];
    }

    if($email){
    $sessao=new Sessao();
    $sessao->Add("codigo",$codigo);
    $sessao->Add("nome",$nome);
    $sessao->Add("email",$email);
    //echo "davi2 $email";exit;
    header("Location:$path");
    }else{
    header("Location: login.php?erro=invalido&campo=Senha");
    exit;
    }

?>