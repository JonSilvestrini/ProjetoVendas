<?php
require "autoload.php";

$conteudo="";

$path=isset($_GET['path'])?$_GET['path']:"index.php";
@$email=$_GET['email'];

if (@$_GET['erro']=="invalido"){
    $conteudo.= new Msg("<script>$(\"#myModal\").modal();<\script>Atenção,login ou senha invalida!");
}
if(@$_GET['erro']=="vazio"){
    $conteudo.= new Msg("Atenção, campo <b>$_GET[campo]</b> em branco!");
}
$form=new Element("form");
$form->action="autentica.php";
$form->method="post";
$form->name="f1";
$form->class="form-inline";

$url=new Element("input");
$url->type="hidden";
$url->name="path";
$url->value="$path";

$label1=new Element("label");
$label1->add("Login:");

$br1=new Element("br");

$iemail=new Element("input");
$iemail->type="text";
$iemail->name="login";
$iemail->size="50";
$iemail->maxlength="50";
$iemail->class="form-control";

$br2=new Element("br");

$label2=new Element("label");
$label2->add("Senha:");

$br3=new element("br");
$br4=new element("br");

$isenha=new Element("input");
$isenha->type="password";
$isenha->name="senha";
$isenha->size="50";
$isenha->maxlength="50";
$isenha->class="form-control";

$bt1=new Element("input");
$bt1->type="submit";
$bt1->value="Acessar";
$bt1->class="btn btn-primary";

$bt2=new Element("input");
$bt2->type="reset";
$bt2->value="Limpar";
$bt2->class="btn btn-primary";

$form->add($url);
$form->add($label1);
$form->add($br1);
$form->add($iemail);
$form->add($br2);
$form->add($label2);
$form->add($br3);
$form->add($isenha);
$form->add($br4);
$form->add($bt1);
$form->add($bt2);

$conteudo=$form->show();

$pagina = new Template("template.html");
$pagina->set("titulo", "login");
$pagina->set("conteudo", "$conteudo");
$pagina->set("rodape", "Login Enquete");
echo $pagina->show();
?>