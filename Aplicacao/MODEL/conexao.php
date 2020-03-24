<?php
	include_once("../VIEW/classeCabecalho.php");

    $bd = "mysql:host=localhost:3307;dbname=pizzanet2;charset=utf8";
    $user = "root";
    $senha = "usbw";

    try{
    	$conexao = new PDO($bd,$user,$senha);
    }
	catch(Exception $e){
		echo "<div class='text-center'>Nosso sistema está indisponivel no momento. Tente novamento mais tarde :'(</h2></div>";
		die();
	}
?>