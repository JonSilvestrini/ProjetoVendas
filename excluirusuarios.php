<?php
    require "autoload.php";

    //$sessao=new Sessao();
    //$sessao->Protege("email");
    
    $con=Conexao::Open();
    $enquete=new Registro("usuarios ",$con);

    if($enquete->delete("usucod=$_GET[codigo]")){
        $pagina = new Template("template.html");
        $pagina->set("titulo", "Exclusão de usuarios");
        $pagina->set("conteudo", new Msg("Usuarios deletados!"));
        $pagina->set("rodape", "Exclusao de usuarios");
        echo $pagina->show();
        header("Refresh: 1; URL=cadusuario.php");
    }




?>