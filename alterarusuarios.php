<?php


    require "autoload.php";

    $con=Conexao::Open();
    $usuario=new Registro("usuarios ",$con);

    $row=$usuario->find("usucod=$_GET[codigo]");
   

    $form=new Element("Form");
    $form->action="gravaaltusuarios.php";
    $form->name="f1";
    $form->method="post";
    $form->class="form-inline";


    $inputcod=new Element("Input");
    $inputcod->type="hidden";
    $inputcod->name="codigo";
    $inputcod->value="$_GET[codigo]";



    $label1=new Element("label");
    $label1->add("NOME:");

    $input1=new Element("Input");
    $input1->type="text";
    $input1->name="nome";
    $input1->size="50";
    $input1->value="$row[usunome]";

    $br1=new Element("br");

    $label2=new Element("label");
    $label2->add("EMAIL:");

    $input2=new Element("Input");
    $input2->type="text";
    $input2->name="email";
    $input2->size="50";
    $input2->value="$row[usulogin]";

    $br2=new Element("br");
    $br5=new Element("br");

    $label3=new Element("label");
    $label3->add("SENHA:");

    $input3=new Element("Input");
    $input3->type="password";
    $input3->name="senha";
    $input3->size="50";

    $br3=new Element("br");
    $br6=new Element("br");

    $label4=new Element("label");
    $label4->add("CONFIRMA A SENHA:");

    $input4=new Element("Input");
    $input4->type="password";
    $input4->name="senha2";
    $input4->size="50";

    $br4=new Element("br");
    $br7=new Element("br");
    

    $bt1=new Element("input");
    $bt1->type="submit";
    $bt1->value="Gravar";
    $bt1->class="btn btn-primary";

    $br8=new Element("br");
   
    $bt2=new Element("input");
    $bt2->type="submit";
    $bt2->value="Limpar";
    $bt2->class="btn btn-primary";

    $form->add($label1);
    $form->add($inputcod);
    $form->add($input1);
    $form->add($br1);
    $form->add($br4);
    $form->add($label2);
    $form->add($input2);
    $form->add($br2);
    $form->add($br5);
    $form->add($label3);
    $form->add($input3);
    $form->add($br3);
    $form->add($br6);
    $form->add($label4);
    $form->add($input4);
    $form->add($br7);
    $form->add($br8);
    $form->add($bt1);
    $form->add($bt2);
    
    $conteudo=$form->show();
 
    
    $pagina=new Template("template.html");
    $pagina->set("titulo","Enquete Eletronico");
    $pagina->set("conteudo", $conteudo);
    $pagina->set("rodape", "Sistema Eletronico");
    echo $pagina->show();
    




    


?>