<?php
	header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=UTF-8');

    $host = "localhost";
    $db = "pizzanet2";
    $user = "root";
    $pass = "usbw";

    $id=$_POST["id"];

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die("Falha na conexão: " .$conn->connect_error);
    }

    $delete_item="DELETE FROM item_pedido WHERE cod_pedido=$id";
    $conn->query($delete_item);

    $delete_pedido="DELETE FROM pedido WHERE id_pedido=$id";
    $conn->query($delete_pedido);

    $conn->close();

    if(isset($_POST["btn"])){
        header("location: listar_pedido.php");
    }
?>