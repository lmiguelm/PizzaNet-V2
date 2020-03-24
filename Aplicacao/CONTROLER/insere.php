<?php
	include("../VIEW/classeCabecalho.php");
	include("../MODEL/classeBancoDeDados.php");
		
	$operacao = new BancoDeDados($conexao);	

	if($_POST["id"]==0){

		unset($_POST["id"]);
	
		if($_GET["tabela"]=='cliente'){

			$consulta="SELECT email FROM cliente";
			$stmt = $conexao->prepare($consulta);
			$stmt->execute();
			while($linha=$stmt->fetch())
			{
				if($linha[0]==$_POST["email"])
				{
					die(header("location: index.php?email"));
				}
			}
			$consulta="SELECT email FROM funcionario";
			$stmt = $conexao->prepare($consulta);
			$stmt->execute();
			while($linha=$stmt->fetch())
			{
				if($linha[0]==$_POST["email"])
				{
					die(header("location: index.php?email"));
				}
			}
			$operacao->insercao($_GET["tabela"],$_POST);

			if(isset($_GET["form"]))
			{
				header('location: listar_'.$_GET["tabela"].'.php?sucesso');
			}
			else
			{
				header('location: index.php?sucesso&nome='.$_POST["nome"].'');
			}
		}
		elseif($_GET["tabela"]=='pedido'){
			
			$operacao->insercao($_GET["tabela"],$_POST);
			header("location: form_item_pedido.php");
		}
		elseif($_GET["tabela"]=='item_pedido'){

			if($_POST["tipo"]==1){

				$_POST["cod_bebida"]=null;

				if($_POST["proporcao"]== 1){

					$_POST["cod_pizza2"]=null;
				}
				elseif($_POST["proporcao"]==2){
							
				}
				else{
					die();
				}
			}
			else if($_POST["tipo"]==2){
				$_POST["proporcao"]=null;
				$_POST["cod_pizza1"]=null;
				$_POST["cod_pizza2"]=null;
			}
			else{
				die();
			}
		
			if($_POST["quantidade"]<=0){
				$_POST["quantidade"]=1;
			}
			
			$operacao->insercao($_GET["tabela"],$_POST);
		}
		elseif ($_GET["tabela"]=='pagamento') {
			$operacao->insercao($_GET["tabela"],$_POST);
			header("location: listar_pedido.php?pagamento");
		}
		else{

			$operacao->insercao($_GET["tabela"],$_POST);
			header('location: listar_'.$_GET["tabela"].'.php?sucesso');
		}	
	}
	else{

		$id=$_POST["id"];
		unset($_POST["id"]);

		if(isset($_GET["mudarsenha"])){

			$permissao=$_GET["permissao"];
			$senha=$_POST["senha_atual"];
			unset($_POST["senha_atual"]);

			if($permissao==0 || $permissao==2){
				$tabela[]="cliente";
				$condicao[]="senha='$senha' AND id_cliente='$id'";
			}else{
				$tabela[]="funcionario";
				$condicao[]="senha='$senha' AND id_funcionario='$id'";
			}
			
			$coluna[]="senha";
			$ordenacao=null;

			$result=$operacao->select($tabela, $coluna, $condicao, $ordenacao);	

			if($result!=null){

				if($permissao==0 || $permissao==2){
					$operacao->alterar($_POST, "cliente", $id);
				}else{
					$operacao->alterar($_POST, "funcionario", $id);
				}
				die(header("location: form_mudar_senha.php?success"));
			}
			else{
				die(header("location: form_mudar_senha.php?erro"));
			}
		}
		else{
			$operacao->alterar($_POST, $_GET["tabela"], $id);

			header('location: listar_'.$_GET["tabela"].'.php');
		}
	}	
?>