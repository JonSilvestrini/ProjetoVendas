<?php
    require "autoload.php";

    //$sessao=new Sessao();
    //$sessao->Protege("email");
    
    $con=Conexao::Open();
    $enquete=new Registro("produtos ",$con);

    if($enquete->delete("codigo=$_GET[codigo]")){
        $pagina = new Template("template.html");
        $pagina->set("titulo", "Exclusão de produtos");
        $pagina->set("conteudo", new Msg("Produtos deletados!"));
        $pagina->set("rodape", "Exclusao de produtos");
        echo $pagina->show();
        header("Refresh: 1; URL=cadprodutos.php");
    }




?>