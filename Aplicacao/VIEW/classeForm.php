<?php
		
	include("classeInputOpcoes.php");
	include("classeSelect.php");
	include("classeButton.php");
	include("classeLabel.php");
	include("classeModal.php");

	class Form implements Exibicao{
		
		private $action;
		private $method;		
		public $entradas;
		private $reset;
		private $nome_submit;
		private $modal;
		
		public function __construct($parametros){
			
			$this->action = $parametros["action"];
			$this->method = $parametros["method"];

			if(isset($parametros["reset"])){
				$this->reset=$parametros["reset"];
			}

			if(isset($parametros["nome_submit"])){
				$this->nome_submit=$parametros["nome_submit"];
			}
			else{
				$this->nome_submit = "Enviar";
			}

			if(isset($parametros["modal"])){
				$this->modal=true;
			}	
			else{
				$this->modal=false;
			}
			
		}

		public function add_button($parametros){
			$this->entradas[] = new Button($parametros);
		}
		
		public function add_input($parametros){
			$this->entradas[] = new Input($parametros);
		}
		
		public function add_inputOpcoes($parametros){
			$this->entradas[] = new InputOpcoes($parametros);
		}		
		
		public function add_select($parametros,$vetor_options){
			$this->entradas[] = new Select($parametros,$vetor_options);
		}

		public function add_label($parametros)
		{
			$this->entradas[] = new Label($parametros);
		}

		public function add_textarea($parametros)
		{
			$this->entradas[] = new Textarea($parametros);
		}
			
		public function exibe(){

			if($this->modal){

				echo "
				<div class='form-group'>
				<form method='$this->method' action='$this->action'>";
							
				
				if($this->entradas!=null)
				foreach($this->entradas as $i=>$e){				
					echo '<div class="row">
	                        <div class="form-group col-sm-12 col-xs-12">';
					$e->exibe();
					echo "</div></div>";
				}
					
				
				echo "
				
					<div class='text-center'>";

						if($this->reset!=null){
							echo "<hr/><button type='reset' class='btn btn-secondary'>Apagar</button>&nbsp;&nbsp;&nbsp;&nbsp;";
						}	
						
						echo "<button type='submit' class='btn btn-primary'>$this->nome_submit</button>
						
					</div>
					
					</form>
				
				</div>";
			}
			else{

				echo "
				<div class='login-form col-xs-10 offset-xs-1 col-sm-6 offset-sm-3 col-md-4 offset-md-4'>
					<form method='$this->method' action='$this->action'>";
						
						foreach($this->entradas as $i=>$e){
							echo "<div class='form-group'>";
								$e->exibe();
							echo "</div>";
						}	
				echo "</form>
				</div>";
			}		
		}
	}
?>