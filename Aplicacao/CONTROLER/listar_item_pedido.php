<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json;charset=UTF-8');
    session_start();
    
    $host = "localhost";
    $db = "pizzanet2";
    $user = "root";
    $pass = "usbw";

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if($conn->connect_error){
        die("Falha na conexão: " .$conn->connect_error);
    }

    if(isset($_POST["id"])){

        $id=$_POST["id"];
        $sql = "SELECT * FROM visao_item_pedido WHERE cod_pedido=\"$id\"";
    }
    else{

        $id_pedido = $_SESSION["id_pedido"];

         $sql = "SELECT * FROM visao_item_pedido WHERE 
        cod_pedido=\"$id_pedido\" ";
    }
    
    $result = $conn->query($sql);

    $output = array();
    $output = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($output);
    $conn->close();

?>