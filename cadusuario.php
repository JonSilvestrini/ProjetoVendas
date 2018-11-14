<?php
    require "autoload.php";

    $form=new Element ("Form");
    $form->action="gravausuario.php";
    $form->name="f1";
    $form->method="post";
    $form->class="form-inline";

    $lbl_nome=new Element("label");
    $lbl_nome->add("NOME");

    $br11=new Element("br");

    $input_nome=new Element("input");
    $input_nome->type="text";
    $input_nome->name="nome";
    $input_nome->size="50";

    $br1=new Element("br");
    $br2=new Element("br");

    $lbl_email=new Element("label");
    $lbl_email->add("EMAIL");

    $input_email=new Element("Input");
    $input_email->type="text";
    $input_email->name="email";
    $input_email->size="50";

    $br3=new Element("br");
    $br4=new Element("br");

    $lbl_senha=new Element("label");
    $lbl_senha->add("SENHA");

    $input_senha=new Element("Input");
    $input_senha->type="password";
    $input_senha->name="senha";
    $input_senha->size="50";

    $br5=new Element("br");
    $br6=new Element("br");

    $lbl_senha2=new Element("label");
    $lbl_senha2->add("CONFIRMAR SENHA");

    $input_senha2=new Element("Input");
    $input_senha2->type="password";
    $input_senha2->name="senha2";
    $input_senha2->size="39";

    $br7=new Element("br");
    $br8=new Element("br");

    $btn_gravar=new Element("Input");
    $btn_gravar->type="submit";
    $btn_gravar->value="Gravar";
    $btn_gravar->class="btn btn-primary";

    $btn_limpar=new Element("Input");
    $btn_limpar->type="submit";
    $btn_limpar->value="Limpar";
    $btn_limpar->class="btn btn-primary";

    $br9=new Element("br");
    $br10=new Element("br");

    $form->add($br11);
    $form->add($lbl_nome);
    $form->add($input_nome);
    $form->add($br1);
    $form->add($br2);
    $form->add($lbl_email);
    $form->add($input_email);
    $form->add($br3);
    $form->add($br4);
    $form->add($lbl_senha);
    $form->add($input_senha);
    $form->add($br5);
    $form->add($br6);
    $form->add($lbl_senha2);
    $form->add($input_senha2);
    $form->add($br7);
    $form->add($br8);
    $form->add($btn_gravar);
    $form->add($btn_limpar);
    $form->add($br9);
    $form->add($br10);

    $conteudo=$form->show();

    $con=Conexao::Open();
    $enquete=new Registro("usuarios ",$con);

    $tab=new Table();
    $tab->class='table table-hover';
    $tab->border='1';
    
    $linha=$tab->addRow();
    $linha->addCell('Codigo');
    $linha->addCell('Nome');
    $linha->addCell('E-mail');

    foreach($enquete->findAll() as $key => $dados){
        $linha=$tab->addRow();
        $linha->addCell($dados[0]);
        $linha->addCell($dados[1]);
        $linha->addCell($dados[2]);
        
        $link=new Element("a");
        $link->href="alterarusuarios.php?codigo=$dados[0]";
        $link->class="btn btn-success btn-xs";
        $link->add("Alterar");

        
        $link2=new Element("a");
        $link2->href="excluirusuarios.php?codigo=$dados[0]\" onclick=\"return confirm('Confirma exclusao do registro?')";
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