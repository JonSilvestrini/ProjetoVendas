<?php

require 'autoload.php';

//$sessao=new Sessao();
//$sessao->Protege("email");

$con = Conexao::Open();
$vendas = new Registro("usuarios",$con);

if($vendas->delete("usucod=$_GET[codigo]")){
	$pagina = new Template('template.html');
	$pagina->set("titulo", "Exclusão de usuários");
	$pagina->set("conteudo", new Msg("Usuário deletado!"));
	$pagina->set("rodape", "Exclusão de usuários");
	echo $pagina->show();
	header("Refresh: 3; URL=cadusuario.php");
}