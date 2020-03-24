<?php	
	include("../VIEW/classeCabecalho.php");	
	include("autenticacao/autenticacao.php");
	include("autenticacao/autenticacao_funcionario.php");
	include('../VIEW/classeCard.php');

	if ($_SESSION["usuario"]->get_permissao()==1) {
		echo"<table class='ta text-center '>";
	}
	else{
		echo"<table class='t text-center '>";
	}
	
		echo "<tr>";
			echo "<th>";
				$parametros=null;
				$parametros["img"]='../img/pizza.jpg';
				$parametros["logotipo"]='Pizza';
				$parametros["title"]='Pizzas';
				$parametros["texto"]='Cadastrar, Alterar, Excluir e Listar';
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
				$parametros["texto"]='Cadastrar, Alterar, Excluir e Listar';
				$parametros["title_button"]='Detalhes';

				$c = new Card($parametros);
				$c->exibe();
			echo"</th>";

			if ($_SESSION["usuario"]->get_permissao()==2) {
				echo "<th>";
					$parametros=null;
					$parametros["img"]='../img/funcionario.png';
					$parametros["logotipo"]='Funcionário';
					$parametros["title"]='Funcionários';
					$parametros["link"]='listar_funcionario.php';
					$parametros["texto"]='Cadastrar, Alterar, Excluir e Listar';
					$parametros["title_button"]='Detalhes';

					$c = new Card($parametros);
					$c->exibe();
				echo"</th>";

				echo "<th>";
					$parametros=null;
					$parametros["img"]='../img/cliente.jpg';
					$parametros["logotipo"]='Cliente';
					$parametros["title"]='Clientes';
					$parametros["link"]='listar_cliente.php';
					$parametros["texto"]='Cadastrar, Alterar, Excluir e Listar';
					$parametros["title_button"]='Detalhes';

					$c = new Card($parametros);
					$c->exibe();
				echo"</th>";
			}
			
		echo "</tr>";
	echo "</table>";

	include("../VIEW/classeRodape.php");
	
?>

