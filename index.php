<?php
##### index.php #####

require "autoload.php";

$codped=isset($_GET['codped'])?$_GET['codped']:'';

if (!is_numeric($codped)){
    $pagina = new Template("template.html");
    $pagina->set("titulo", "Vendas");
    $pagina->set("conteudo","Clique no botão [Novo Pedido] para iniciar.");
    $pagina->set("rodape","Etecleme");
    echo $pagina->show();
    exit;
}

$spanvalor=new Element("span");
$spanvalor->class="valor";
$spanvalor->id="valor";

$form=new Element("form");
$form->action="gravaitem.php";
$form->method="post";
$form->name="form1";
$form->class="form-inline";
$form->onSubmit="return false";

$icodped=new Element("input");
$icodped->type="hidden";
$icodped->name="codped";
$icodped->value="$codped";

$label1=new Element("input");
$label1->add("Produto:");

$icodprod=new Element("input");
$icodprod->type="text";
$icodprod->name="codprod";
$icodprod->id="codprod";
$icodprod->size="3";
$icodprod->maxlength="3";

$inqtde = new Element("input");
$inqtde->type="text";
$inqtde->name="qtde";
$inqtde->id="qtde";
$inqtde->size="3";

$span3 = new Element("span");
$span3->class="qtde";
$span3->add("Quantidade:");
$span3->add($inqtde);

$span4 = new Element("span");
$span4->class="corrige";
$span4->tabindex="0";
$imgcor = new Element("img");
$imgcor->src="img/corrige.png";
$imgcor->width="60";
$imgcor->height="50";
$imgcor->onClick="limpar();";
$span4->add($imgcor);
$span4->add("<br>");

$btconf = new Element("input");
$btconf->type="button";
$btconf->class="confirma";
$btconf->value="Confirma";
$btconf->id="confirma";
$btconf->onClick="enviar();";

$div2=new Element("div");
$div2->class="informe";

$tab=new Table();
$tab->class="tabela";
$tab->borde="1";

$linha=$tab->addRow();
$linha->addCell('Cód');
$linha->addCell('Prod');
$linha->addCell('Qtde');
$linha->addCell('R$');
$linha->addCell('Subtotal');
$linha->addCell('Excluir');

$con=Conexao::Open();
$consulta=new Registro("pedidos", $con);
$tabelas="pedidos, itens, produtos";
$criterio="pedidos.codped=itens.pedido and itens.codprod=produtos.codigo and pedidos.codped=$codped";

$total=0;
foreach($consulta->findTabelas("*", $tabelas,$criterio) as $key =>$dados)
{

    $subtotal=$dados[8]*$dados[11];
    $total=$total+$subtotal;

$linha=$tab->addRow();
$linha->addCell($dados[6]);
$linha->addCell($dados[10]);
$linha->addCell($dados[8]);
$linha->addCell($dados[11]);
$linha->addCell($subtotal);
$link2= new Element("a");
$link2->href="excluiritem.php?coditem=$dados[4]&codped=$dados[0]\"onclick=\"return confirm('Confirma exclusão do registro?')";
$link2->class="btn btn-danger btn-xs";
$link2->add("Excluir");

$linha->addCell($link2);
}

$consulta2=new Registro("pedidos", $con);
$campos="sum(itens.qtde*itens.valor) as total, pedidos.dinheiro, pedidos.troco";
$tabelas="pedidos,itens";
$criterio="pedidos.codped=$codped and pedidos.codped=itens.pedido";
foreach($consulta2->findTabelas("*", $tabelas, $criterio) as $key=>$dados2)
{
$pedidototal=$dados2[0];
$pedidodinheiro=$dados2[2];
$pedidotroco=$dados2[3];

}

$linha=$tab->addRow();
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha=$tab->addRow();
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('Total');
$linha->addCell($total);
$linha->addCell('-');
$linha=$tab->addRow();
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('Dinheiro');

$form2= new Element("form");
$form2->name="f1";
$form2->method="post";
$form2->action="troco.php";

$incoped=new Element("input");
$incoped->type="hidden";
$incoped->name="codped";
$incoped->value="$codped";

$intotal=new Element("input");
$intotal->type="hidden";
$intotal->name="total";
@$intotal->value="$total";


$indinheiro= new Element("input");
$indinheiro->type="";
$indinheiro->name="";
$indinheiro->value="";


?>