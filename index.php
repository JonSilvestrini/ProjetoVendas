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
$indinheiro->type="text";
$indinheiro->name="dinheiro";
$indinheiro->size="5";
@$indinheiro->value="$pedidodinheiro";

$insub = new Element("input");
$insub->type="submit";
$insub->value="Calcular Troco";

$form2->add($incoped);
$form2->add($intotal);
$form2->add($indinheiro);
$form2->add($insub);
$linha->addCell($form2);
$linha->addCell('-');
$linha=$tab->addRow();
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('-');
$linha->addCell('Troco');
$linha->addCell($pedidotroco);
$linha->addCell('-');

$tab2=new Table();
$tab2->class='preco';
$tab2->border='1';
$tab2->width='100%';
$linha=$tab2->addRow();
$linha->addCell('Cod');
$linha->addCell('Produto');
$linha->addCell('R$');

$enquete=new Registro("produtos",$con);
foreach($enquete->findAll() as $key => $dados) {
    $linha=$tab2->addRow();
    $linha -> addCell($dados[0]);
    $linha -> addCell($dados[1]);
    $linha -> addCell($dados[2]);
}

$form->add($icodped);
$form->add("<br><br>");
$div2->add($label1);
$div2->add($icodped);
$spanvalor->add("");
$div2->add($span3);
$div2->add($btconf);
$div2->add($span4);

$form->add($div2);

$conteudo=$form->show();
$conteudo.=$tab->show();
$conteudo.=$tab2->show();

$pagina = new Template("template.html");
$pagina->set("titulo", "Vendas");
$pagina->set("conteudo", $conteudo);
$pagina->set("rodape", "Etecleme");
echo $pagina->show();
?>