<?php
    require "autoload.php";

    $con=Conexao::Open();
    $enquete=new Registro("usuarios",$con);
    $enquete->usucod="0";
    $enquete->usunome=$_POST['nome'];
    $enquete->usulogin=$_POST['email'];
    $enquete->ususenha=$_POST['senha'];
    
    if ( $_POST['senha']== $_POST['senha2']){
        $enquete->ususenha=sha1($enquete->ususenha);
        if ($enquete->save()){
            $pagina = new Template("template.html");
            $pagina->set("titulo","USUARIO SALVO COM SUCESSO!");
            $pagina->set("conteudo", new Msg("OBRIGADO PELA RESPOSTA!"));
            $pagina->set("rodape","enquete");
            echo $pagina->show();
            header("Refresh: 1; URL=cadusuario.php");
    }
}else {
    $pagina = new Template("template.html");
    $pagina->set("titulo","Senha diferente");
    $pagina->set("conteudo", new Msg("VERIFIQUE SE SENHAS SAO IGUAIS!"));
    $pagina->set("rodape","enquete");
    echo $pagina->show();
    header("Refresh: 1; URL=cadusuario.php");
}
?>