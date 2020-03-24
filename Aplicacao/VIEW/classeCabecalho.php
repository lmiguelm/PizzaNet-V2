<?php
	
	include("../MODEL/classeUsuario.php");
	include("interfaceExibicao.php");

	class Cabecalho implements Exibicao{
	
		private $charset;
		private $title;
		private $links;
		private $icone;
		
		public function __construct($parametros){
			$this->charset = $parametros["charset"];
			$this->title = $parametros["title"];
			if(isset($parametros["links"])){
				$this->links = $parametros["links"];
			}
			if(isset($parametros["icone"])){
				$this->icone=$parametros["icone"];
			}
		}
		
		public function exibe(){
			session_start();
		
			echo "<!DOCTYPE html>
					<html>
					<head>
						 <meta name='viewport' 
							content='width=device-width, initial-scale=1' />
							
						<meta charset='$this->charset' />
						 <title>$this->title</title>";
			if($this->links!=null){
					foreach($this->links as $i=>$l){
						echo "<link rel='stylesheet' href='$l' />";
					}
			}			 
			if($this->icone!=null){
					
				echo "<link rel='icon' type='image/png' href='$this->icone'/>";
				
			}	
		
			echo '
					</head>	
						<body>
			';
		}
		
		public function exibe_menu(){
			
			if(isset($_SESSION["usuario"])){
				echo'
				<nav class="navbar navbar-dark navbar-expand-md fixed-top" style="background-color:#5c0d00">
					  
				 	<a href="index.php" class="navbar-brand logotipo">
			 			<img src="../img/icone.png"class="d-inline-block align-top" alt="Logotipo"/>
			 			<b>PizzaNet</b>
			 		</a>

		 			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
		 				<span class="navbar-toggler-icon"></span>
		 			</button>';
			 		
			 	if($_SESSION["usuario"]->get_permissao()==0){
			 		echo'
		 			<div class="collapse navbar-collapse" id="menu">
		 				<ul class="nav navbar-nav">
			 				<li class="nav-item"><a class="nav-link" href="listar_cardapio.php">Cardápio</a></li>
			 				<li class="nav-item"><a class="nav-link" href="listar_pedido.php">Fazer Pedido</a></li>
			 				<li class="nav-item"><a class="nav-link" href="listar_historico.php">Historico de Pedidos</a></li>
		 				</ul>

		 				<div class="navbar-nav flex-row ml-md-auto  d-md-flex">
			 				<div class="btn-group">
			 					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#7a1100; border: #7a1100"><b>'.$_SESSION["usuario"]->get_nome().'</b></button>

			 					<div class="dropdown-menu dropdown-menu-right">
			 						<button class="dropdown-item" type="button" id="btnDados">Meus Dados</button>
			 						<button class="dropdown-item" type="button" id="btnSenha">Alterar Senha</button>
			 						<button class="dropdown-item" type="button" id="btnFale">Contato</button>
			 						<button class="dropdown-item" type="button" id="btnLogout">Sair</button>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 		';
			 	}	
			 	elseif($_SESSION["usuario"]->get_permissao()==1){
			 		echo'
		 			<div class="collapse navbar-collapse" id="menu">
		 			
		 				<ul class="nav navbar-nav">
			 				<li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastrar / Listar</a></li>
			 				<li class="nav-item"><a class="nav-link" href="listar_pedido.php">Checar Pedidos</a></li>
		 				</ul>
		 				

		 				<div class="navbar-nav flex-row ml-md-auto  d-md-flex">
			 				<div class="btn-group">
			 					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#7a1100; border: #7a1100"><b>'.$_SESSION["usuario"]->get_nome().'</b></button>

			 					<div class="dropdown-menu dropdown-menu-right">
			 						<button class="dropdown-item" type="button" id="btnSenha">Alterar Senha</button>
			 						<button class="dropdown-item" type="button" id="btnLogout">Sair</button>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 		';
			 	}
			 	else{
			 		echo'
			 		<div class="collapse navbar-collapse" id="menu">
		 				<ul class="nav navbar-nav">
			 				<li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastrar / Listar</a></li>
			 				<li class="nav-item"><a class="nav-link" href="listar_pedido.php">Pedidos</a></li>
			 				<li class="nav-item"><a class="nav-link" href="listar_historico.php">Historico de Pedidos</a></li>
			 			</ul>

			 			<div class="navbar-nav flex-row ml-md-auto  d-md-flex">
			 				<div class="btn-group">
			 					<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color:#7a1100; border: #7a1100"><b>'.$_SESSION["usuario"]->get_nome().'</b></button>

			 					<div class="dropdown-menu dropdown-menu-right">
			 						<button class="dropdown-item" type="button" id="btnSenha">Alterar Senha</button>
			 						<button class="dropdown-item" type="button" id="btnLogout">Sair</button>
			 					</div>
			 				</div>
			 			</div>
			 		</div>
			 		';
			 	}
			}
			else
			{
				echo'
				<nav class="navbar navbar-dark navbar-expand-md fixed-top" style="background-color:#5c0d00">
					   
				 	<a href="index.php" class="navbar-brand logotipo">
			 			<img src="../img/icone.png" alt="Logotipo"/>
			 			<b>PizzaNet</b>
			 		</a>

		 			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
		 				<span class="navbar-toggler-icon"></span>
		 			</button>

		 			<div class="collapse navbar-collapse" id="menu">
		 				
		 				
						<div class="navbar-nav flex-row ml-md-auto  d-md-flex">
							<form action="validacao.php" method="post" class="form-inline">
								<div class="row">

									<div class="col-sm-2.5 col-xs-12">
			                      		<a class="form-group esqueci nav-link" href="form_resetar_senha.php">Esqueci a senha</a>
			                      	</div>

				                	<div class="form-group col-sm-4 col-xs-12">
			                        	<input type="email" name="email" required="required" class="form-control form-control-sm" placeholder="Email" />
			                        </div>
			                 
			                   		<div class="form-group col-sm-4 col-xs-12">
			                       		 <input type="password" name="senha" required="required" placeholder="Senha" class="form-control form-control-sm password" data-cript="md5, sha1"/>
			                        </div>&nbsp;&nbsp;
			                   
			                   		<div class="form-group col-sm-1.5 col-xs-12">
			                      		 <button style="background-color:#7a1100; border: #7a1100" class="btn btn-primary btn-sm">Entrar</button>
			                      	</div>
				                </div>
				             </form>
						</div>
				    </div>
		 			';	
			}
			echo '</nav>
			<div class="corpo">';
		}
	}
	
	$parametros["charset"]="utf-8";
	$parametros["title"]="PizzaNet";
	$parametros["icone"] = "../img/icone.png";
	$parametros["links"][] = "../css/bootstrap.min.css";
	$parametros["links"][] = "../css/estilos.css";
	$parametros["links"][] = "../css/bootstrap-datepicker.min.css";
	$parametros["links"][] = "https://fonts.googleapis.com/icon?family=Material+Icons";

	$c=new Cabecalho($parametros);
	$c->exibe();	
	$c->exibe_menu();
?>


	