<?php

	include("classeInput.php");

	class InputOpcoes extends Input{
		
		private $opcoes;
		
		public function __construct($parametros){
			parent::__construct($parametros);
			$this->opcoes = $parametros["opcoes"];
		}
		
		public function exibe(){
			
			echo "<label>".
					$this->get_label().
				  ": </label>";
			
			foreach($this->opcoes as $valor=>$label){
				echo "
				<input type='".$this->get_type()."' 
				       name='".$this->get_name()."' 
					   value='$valor' checked /> <label>$label</label> ";
			}
		}
	}
?>