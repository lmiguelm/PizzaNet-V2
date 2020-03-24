<?php

	class Textarea implements Exibicao{
		
		private $value;
		private $placeholder;
		private $label;
		private $class;
		private $required;
		private $id;
		private $name;
			
		public function __construct($parametros){
			$this->name = $parametros["name"];
			
			if(isset($parametros["id"])){
				$this->id = $parametros["id"];
			}
			if(isset($parametros["value"])){
				$this->value = $parametros["value"];
			}
			if(isset($parametros["placeholder"])){
				$this->placeholder = $parametros["placeholder"];
			}
			if(isset($parametros["label"])){
				$this->label = $parametros["label"];
			}
			if(isset($parametros["class"])){
				$this->class = $parametros["class"];
			}			
			if(isset($parametros["required"])){
				$this->required = $parametros["required"];
			}
		}
		
		public function exibe(){
			
			if($this->label!=null){
				echo "<label>$this->label</label>";
			}

			echo "<textarea name='$this->name'";
						
				if($this->placeholder!=null){
					echo " placeholder='$this->placeholder' ";
				}
				if($this->class!=null){
					echo " class='$this->class'";
				}
				if($this->required!=null){
					echo " required='$this->required' ";
				}
				if($this->value!=null){
					echo " value='$this->value' ";
				}
				if($this->id!=null){
					echo " id='$this->id' ";
				}

			echo "></textarea>";
		}
		
		public function get_name(){
			return($this->name);
		}

		public function get_label(){
			return($this->label);
		}

		public function get_value(){
			return($this->value);
		}

		public function get_placeholder(){
			return($this->placeholder);
		}

		public function get_id(){
			return($this->id);
		}

		public function get_required(){
			return($this->required);
		}

		public function get_class(){
			return($this->class);
		}
	}

?>