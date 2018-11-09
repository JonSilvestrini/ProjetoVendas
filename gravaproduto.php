<?php
    require "autoload.php";

    $con=Conexao::Open();
    $enquete=new Registro("produtos",$con);
    $enquete->codigo="0";
    $enquete->descricao=$_POST['descricao'];
    $enquete->valor=$_POST['valor'];
    $enquete->estoque=$_POST['estoque'];
    $enquete->estoquemin=$_POST['estoquemin'];


  
if ($enquete->save()){
            $pagina = new Template("template.html");
            $pagina->set("titulo","PRODUTO SALVO COM SUCESSO!");
            $pagina->set("conteudo", new Msg("OBRIGADO PELA RESPOSTA!"));
            $pagina->set("rodape","enquete");
            echo $pagina->show();
            header("Refresh: 1; URL=cadprodutos.php");
    
}else {
    $pagina = new Template("template.html");
    $pagina->set("titulo","Senha diferente");
    $pagina->set("rodape","enquete");
    echo $pagina->show();
    header("Refresh: 1; URL=cadprodutos.php");
}
?>