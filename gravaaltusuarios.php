<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require "autoload.php";

//$sessao=new Sessao();
//$sessao->Protege("email");

$con = Conexao::Open();
$vendas = new Registro("usuarios", $con);


$vendas->usucod = $_POST['codigo'];
$vendas->usunome = $_POST['nome'];
$vendas->usulogin = $_POST['login'];
$vendas->ususenha = $_POST['senha'];


if ($vendas->ususenha != $_POST['senha2']) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Erro.");
	$pagina->set("conteudo", new Msg("Senhas diferentes"));
	$pagina->set("rodape", "Erro");
	echo $pagina->show();
	header("Refresh: 1; URL=alterausuario.php");
	exit();
}
//$enquete->save();

$vendas->ususenha = sha1($vendas->ususenha);

if ($vendas->save("usucod=$vendas->usucod")) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Obrigado.");
	$pagina->set("conteudo", new Msg("Usuário Alterado com sucesso!"));
	$pagina->set("rodape", "Obrigado.");
	echo $pagina->show();
	header("Refresh: 3; URL=cadusuario.php");
}
?>