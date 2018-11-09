<?php

    require "autoload.php";

    $form=new Element ("Form");
    $form->action="gravaproduto.php";
    $form->name="f1";
    $form->method="post";
    $form->class="form-inline";

    $br1=new Element("br");
    $br2=new Element("br");

    $lbl_usuario=new Element("label");
    $lbl_usuario->add("USUARIO:");
    session_start();
    $lbl_usuario->add($_SESSION['nome']);

    $br3=new Element("br");
    $br4=new Element("br");

    $lbl_descricao=new Element("label");
    $lbl_descricao->add("DESCRIÇAO:");

    $input_descricao=new Element("Input");
    $input_descricao->type="text";
    $input_descricao->name="descricao";
    $input_descricao->size="50";

    $br5=new Element("br");
    $br6=new Element("br");

    $lbl_valor=new Element("label");
    $lbl_valor->add("VALOR:");

    $input_valor=new Element("Input");
    $input_valor->type="text";
    $input_valor->name="valor";
    $input_valor->size="15";


    $br7=new Element("br");
    $br8=new Element("br");

    $lbl_estoque=new Element("label");
    $lbl_estoque->add("QUANTIDADE EM ESTOQUE:");

    $input_estoque=new Element("Input");
    $input_estoque->type="text";
    $input_estoque->name="estoque";
    $input_estoque->size="15";


    $br9=new Element("br");
    $br10=new Element("br");

    $lbl_min_estoque=new Element("label");
    $lbl_min_estoque->add("QUANTIDADE MINIMA EM ESTOQUE:");

    $input_min_estoque=new Element("Input");
    $input_min_estoque->type="text";
    $input_min_estoque->name="estoquemin";
    $input_min_estoque->size="15";


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

    $con=Conexao::Open();
    $enquete=new Registro("produtos ",$con);

    $tab=new Table();
    $tab->class='table table-hover';
    $tab->border='1';
    
    $linha=$tab->addRow();
    $linha->addCell('Codigo');
    $linha->addCell('Descricao');
    $linha->addCell('Valor');
    $linha->addCell('Alterar');
    $linha->addCell('Excluir');


    foreach($enquete->findAll() as $key => $dados){
        $linha=$tab->addRow();
        $linha->addCell($dados[0]);
        $linha->addCell($dados[1]);
        $linha->addCell($dados[2]);
        $linha->addCell($dados[3]);
        $linha->addCell($dados[4]);
        
        $link=new Element("a");
        $link->href="alterarproduto.php?codigo=$dados[0]";
        $link->class="btn btn-success btn-xs";
        $link->add("Alterar");

        
        $link2=new Element("a");
        $link2->href="excluirproduto.php?codigo=$dados[0]\" onclick=\"return confirm('Confirma exclusao do registro?')";
        $link2->class="btn btn-danger btn-xs";
        $link2->add("Excluir");

        $linha->addCell($link.$link2);
    
    }

    $conteudo.= $tab->show();

    $pagina=new Template("template.html");
    $pagina->set("titulo","Enquete Eletronico");
    $pagina->set("conteudo", $conteudo);
    $pagina->set("rodape", "Sistema Eletronico");
    echo $pagina->show();


?>