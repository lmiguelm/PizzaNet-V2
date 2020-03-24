<?php

	include("classeOption.php");

	class Select implements Exibicao{

		private $name;
		private $options;
		private $class;
		private $id;
		
		public function __construct($parametros,$vetor_options){
			$this->name=$parametros["name"];

			if(isset($parametros["class"])){
				$this->class=$parametros["class"];
			}

			if(isset($parametros["id"])){
				$this->id=$parametros["id"];
			}

			foreach($vetor_options as $i=>$o){
				$this->options[] = new Option($o);
			}	
		}
		
		public function exibe(){
			
			echo "<select name='$this->name'";
			
				if($this->id!=null){
					echo "id='$this->id'";
				}
				
				if($this->class!=null){
					echo "class='$this->class'";
				}

			echo ">";

			foreach($this->options as $i=>$o){
				$o->exibe();
			}
			
			echo "</select>";
		}
	}
?>