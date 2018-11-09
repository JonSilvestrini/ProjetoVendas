<?php
    require "autoload.php";

    // $sessao=new Sessao();
    //$sessao->Protege("email");

    $con=Conexao::Open();
    $enquete=new Registro("produtos",$con);
    $enquete->codigo="0";
    $enquete->descricao=$_POST['descricao'];
    $enquete->valor=$_POST['valor'];
    $enquete->estoque=$_POST['estoque'];
    $enquete->estoquemin=$_POST['estoquemin'];
    


            
if ($enquete->save("codigo=$_POST[codigo]")){
           // echo "lucas2";exit;
            $pagina = new Template("template.html");
            $pagina->set("titulo","Produtos salvo com sucesso!");
            $pagina->set("conteudo", new Msg("Obrigado pela resposta!"));
            $pagina->set("rodape","enquete");
            echo $pagina->show();
            header("Refresh: 3; URL=cadprodutos.php");
    
}else {
    $pagina = new Template("template.html");
    $pagina->set("titulo","Senha diferente");
    $pagina->set("rodape","enquete");
    echo $pagina->show();
    header("Refresh: 3; URL=cadusuario.php");
}
?>