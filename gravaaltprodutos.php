<?php
    require "autoload.php";

    // $sessao=new Sessao();
    //$sessao->Protege("email");

    $con=Conexao::Open();
    $vendas=new Registro("produtos",$con);
    $vendas->codigo=$_POST['codigo'];
    $vendas->descricao=$_POST['descricao'];
    $vendas->valor=$_POST['valor'];
    $vendas->estoque=$_POST['estoque'];
    $vendas->estoquemin=$_POST['estoquemin'];
    


            
if   
    ($vendas->save("codigo=$_POST[codigo]")){
           // echo ;exit;
            $pagina = new Template("template.html");
            $pagina->set("conteudo", new Msg("Dados alterados com sucesso"));
            echo $pagina->show();
            header("Refresh: 3; URL=cadproduto.php");
    
}else {
    $pagina = new Template("template.html");
    echo $pagina->show();
    header("Refresh: 3; URL=cadproduto.php");
}
?>