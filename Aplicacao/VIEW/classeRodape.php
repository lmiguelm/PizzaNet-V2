<?php
	class Rodape implements Exibicao{

		private $scripts;
		
		public function __construct($parametros){
			
			$this->scripts = $parametros["scripts"];
			
		}
		
		public function exibe(){
				
			foreach($this->scripts as $i=>$s){
				echo "<script type='text/javascript' src='$s'></script>";
			}
			echo "</body>
				</html>";	
		}
	}
	$parametros=null;
	$parametros["scripts"][] ="../js/jquery.js";
	$parametros["scripts"][] ="../js/bootstrap.bundle.min.js";
	$parametros["scripts"][] ="../js/bootstrap-datepicker.min.js";
	$parametros["scripts"][] ="../js/bootstrap-datepicker.pt-BR.min.js";
	$parametros["scripts"][] ="../js/validaform.min.js";
	$parametros["scripts"][] ="../js/jquery.mask.js";
	$parametros["scripts"][] = "../js/pizzanet.js";
	$parametros["scripts"][] = "../js/login.js";
	$parametros["scripts"][] ="../js/alterar.js";

	$r=New Rodape($parametros);
	$r->exibe();
?>


	