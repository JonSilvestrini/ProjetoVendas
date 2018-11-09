<?php


require "autoload.php";

$con=Conexao::Open();

$produtos=new Registro("produtos ",$con);

$row=$produtos->find("codigo=$_GET[codigo]");

$form=new Element ("Form");
$form->action="gravaaltprodutos.php";
$form->name="f1";
$form->method="post";
$form->class="form-inline";


$inputcod=new Element("Input");
$inputcod->type="hidden";
$inputcod->name="codigo";
$inputcod->value="$_GET[codigo]";

$br1=new Element("br");
$br2=new Element("br");

$lbl_usuario=new Element("label");
$lbl_usuario->add("USUARIO:");

$br3=new Element("br");
$br4=new Element("br");

$lbl_descricao=new Element("label");
$lbl_descricao->add("DESCRIÇAO:");

$input_descricao=new Element("Input");
$input_descricao->type="text";
$input_descricao->name="descricao";
$input_descricao->size="50";
$input_descricao->value="$row[descricao]";

$br5=new Element("br");
$br6=new Element("br");

$lbl_valor=new Element("label");
$lbl_valor->add("VALOR:");

$input_valor=new Element("Input");
$input_valor->type="text";
$input_valor->name="valor";
$input_valor->size="15";
$input_valor->value="$row[valor]";


$br7=new Element("br");
$br8=new Element("br");

$lbl_estoque=new Element("label");
$lbl_estoque->add("QUANTIDADE EM ESTOQUE:");

$input_estoque=new Element("Input");
$input_estoque->type="text";
$input_estoque->name="estoque";
$input_estoque->size="15";
$input_estoque->value="$row[estoque]";


$br9=new Element("br");
$br10=new Element("br");

$lbl_min_estoque=new Element("label");
$lbl_min_estoque->add("QUANTIDADE MINIMA EM ESTOQUE:");

$input_min_estoque=new Element("Input");
$input_min_estoque->type="text";
$input_min_estoque->name="estoquemin";
$input_min_estoque->size="15";
$input_min_estoque->value="$row[estoquemin]";


$br11=new Element("br");
$br12=new Element("br");

$btn_gravar=new Element("Input");
$btn_gravar->type="submit";
$btn_gravar->value="Gravar";
$btn_gravar->class="btn btn-primary";

$btn_limpar=new Element("Input");
$btn_limpar->type="submit";
$btn_limpar->value="Limpar";
$btn_limpar->class="btn btn-primary";

$br13=new Element("br");
$br14=new Element("br");

$form->add($br1);
$form->add($br2);
$form->add($inputcod);
$form->add($lbl_usuario);
$form->add($br3);
$form->add($br4);
$form->add($lbl_descricao);
$form->add($input_descricao);
$form->add($br5);
$form->add($br6);
$form->add($lbl_valor);
$form->add($input_valor);
$form->add($br7);
$form->add($br8);
$form->add($lbl_estoque);
$form->add($input_estoque);
$form->add($br9);
$form->add($br10);
$form->add($lbl_min_estoque);
$form->add($input_min_estoque);
$form->add($br11);
$form->add($br12);
$form->add($btn_gravar);
$form->add($btn_limpar);
$form->add($br13);
$form->add($br14);


$conteudo=$form->show();
    
    $pagina=new Template("template.html");
    $pagina->set("titulo","Enquete Eletronico");
    $pagina->set("conteudo", $conteudo);
    $pagina->set("rodape", "Sistema Eletronico");
    echo $pagina->show();
    

?>