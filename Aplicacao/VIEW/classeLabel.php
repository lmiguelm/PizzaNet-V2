<?php

	class Label implements Exibicao
	{	
		private $label;

		public function __construct($parametros){
			
			if(isset($parametros["label"])){
				$this->label = $parametros["label"];
			}
		}

		public function exibe(){
			echo'<label>'.$this->label.': </label>';
		}	
	}
?>
