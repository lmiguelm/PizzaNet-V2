<?php
	
	class Card implements Exibicao{

		private $img;
		private $logotipo;
		private $title;
		private $texto;
		private $link;
		private $classe_button;
		private $title_button;

		public function __construct($parametros){

			$this->img=$parametros["img"];
			$this->logotipo=$parametros["logotipo"];
			$this->title=$parametros["title"];
			$this->link=$parametros["link"];
			$this->title_button=$parametros["title_button"];

			if(isset($parametros["texto"])){
				$this->texto=$parametros["texto"];
			}

			if(isset($parametros["classe_button"])){

				$this->classe_button=$parametros["classe_button"];
			}
			else{
				$this->classe_button='btn btn-primary';
			}
		}

		public function exibe(){

			echo 
			'	
				<div class="col-sm-6">
					<div class="card" style="width: 18rem;">
					  <img src="'.$this->img.'" class="card-img-top" alt="'.$this->logotipo.'">
					  <div class="card-body">
					    <h5 class="card-title">'.$this->title.'</h5>
					';if($this->texto!=null){
						echo' <p class="p text-muted card-text">
					    		'.$this->texto.'
					    	</p>';
					}echo'
					   
					    <a href="'.$this->link.'" class="'.$this->classe_button.'">'.$this->title_button.'</a>
					  </div>
					</div>
				</div>
			';
		}
	}
?>