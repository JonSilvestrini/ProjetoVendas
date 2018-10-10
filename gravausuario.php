<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);
require "autoload.php";
$con = Conexao::Open();
$vendas = new Registro("usuarios", $con);
$vendas->usucod = "0";
$vendas->usunome = $_POST['txtnome'];
$vendas->usulogin = $_POST['txtlogin'];
$vendas->ususenha = $_POST['txtsenha'];
if ($vendas->ususenha != $_POST['txtsenha2']) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Erro.");
	$pagina->set("conteudo", new Msg("Senhas diferentes"));
	$pagina->set("rodape", "Enquete");
	echo $pagina->show();
	header("Refresh: 1; URL=cadusuario.php");
	exit();
}
//$vendas->save();
$vendas->ususenha = sha1($vendas->ususenha);
if ($vendas->save()) {
	$pagina = new Template("template.html");
	$pagina->set("titulo", "Obrigado.");
	$pagina->set("conteudo", new Msg("Usuário Cadastrado com sucesso!"));
	$pagina->set("rodape", "Enquete");
	echo $pagina->show();
	header("Refresh: 1; URL=cadusuario.php");
}
?>