<?php

	class Option implements Exibicao{
		private $value;
		private $label;
		
		public function __construct($parametros){
			$this->label = $parametros["label"];
			if(isset($parametros["value"])){
				$this->value = $parametros["value"];
			}
		}
		
		public function exibe(){
			echo "<option";
			
			if($this->value!=null){
				echo " value='$this->value'";
			}
			
			echo ">$this->label</option>";
		}
		
	}
?>	