<?php
    require "autoload.php";

    //$sessao=new Sessao();
    //$sessao->Protege("email");
    
    $con=Conexao::Open();
    $enquete=new Registro("produtos ",$con);

    if($enquete->delete("codigo=$_GET[codigo]")){
        $pagina = new Template("template.html");
        $pagina->set("titulo", "Exclusão de produto");
        $pagina->set("conteudo", new Msg("Produto deletado!"));
        $pagina->set("rodape", "Exclusao de produto");
        echo $pagina->show();
        header("Refresh: 1; URL=cadproduto.php");
    }




?>