<?php
   
    include("../MODEL/classeBancoDeDados.php");

    $operacao=new BancoDeDados($conexao);

    $id = $_POST["id"];
    unset($_POST["id"]);

    $operacao->alterar($_POST, "pedido", $id);
?>