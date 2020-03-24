<?php	
	include("../VIEW/classeCabecalho.php");	
	include("autenticacao/autenticacao.php");
	include('../VIEW/classeCard.php');

	echo"<table class='ta text-center '>";

		echo "<tr>";
			echo "<th>";
				$parametros=null;
				$parametros["img"]='../img/pizza.jpg';
				$parametros["logotipo"]='Pizza';
				$parametros["title"]='Pizzas';
				$parametros["link"]='listar_pizza.php';
				$parametros["title_button"]='Detalhes';

				$c = new Card($parametros);
				$c->exibe();
			echo"</th>";
		
			echo "<th>";
				$parametros=null;
				$parametros["img"]='../img/bebida.jpg';
				$parametros["logotipo"]='Bebida';
				$parametros["title"]='Bebidas';
				$parametros["link"]='listar_bebida.php';
				$parametros["title_button"]='Detalhes';

				$c = new Card($parametros);
				$c->exibe();
			echo"</th>";
		echo "</tr>";
	echo "</table>";

	include("../VIEW/classeRodape.php");
	
?>

