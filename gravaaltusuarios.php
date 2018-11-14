<?php
    require "autoload.php";

    // $sessao=new Sessao();
    //$sessao->Protege("email");

    $con=Conexao::Open();
    $enquete=new Registro("usuarios",$con);
    $enquete->usunome=$_POST['nome'];
    $enquete->usulogin=$_POST['email'];
    $enquete->ususenha=$_POST['senha'];
    


    if ( $_POST['senha']== $_POST['senha2']){
            $enquete->ususenha=sha1($enquete->ususenha);
        if ($enquete->save("usucod=$_POST[codigo]")){
           // echo "lucas2";exit;
            $pagina = new Template("template.html");
            $pagina->set("titulo","Usuario salvo com sucesso!");
            $pagina->set("conteudo", new Msg("Obrigado pela resposta!"));
            $pagina->set("rodape","enquete");
            echo $pagina->show();
            header("Refresh: 3; URL=cadusuario.php");
    }
    }else {
    $pagina = new Template("template.html");
    $pagina->set("titulo","Senha diferente");
    $pagina->set("conteudo", new Msg("Verificar se senhas estão iguais!"));
    $pagina->set("rodape","enquete");
    echo $pagina->show();
    header("Refresh: 3; URL=cadusuario.php");
}
?>