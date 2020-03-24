<?php

	class Button implements Exibicao{
		
		private $label;
		private $id;
		private $class;
		
		public function __construct($parametros){
			$this->label = $parametros["label"];

			if(isset($parametros["id"])){
				$this->id=$parametros["id"];
			}

			if(isset($parametros["class"])){
				$this->class=$parametros["class"];
			}
		}
		
		public function exibe(){
			echo 
			'	<div class="text-center">
                       <button type="submit"'; if($this->id!=null){echo"id='$this->id'";} if($this->class!=null){echo"class='$this->class'";}echo'>'.$this->label.'</button>
                </div>
			';	
		}
	}
?>