<?php

	class Modal implements Exibicao{
		
		private $form;	
		private $modal_title;
		private $btn_title;
		private $exibe;
		
		public function __construct(Form $f, $parametros){			
			$this->form = $f;

			if (isset($parametros["btn_title"])) {
				$this->btn_title=$parametros["btn_title"];
			}
			$this->modal_title=$parametros["modal_title"];
			
			if(isset($parametros["exibe"])){
				$this->exibe=$parametros["exibe"];
			}
		}

		
		public function exibe(){
			
			if($this->exibe==null){
				echo'
					<div class="text-center">
                    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NovoCadastro">
                        '.$this->btn_title.'</button>
               		 </div>
				';
			}

			echo'
				<div class="modal" tabindex="-1" role="dialog" id="NovoCadastro">
	        		<div class="modal-dialog" role="document">
	          			<div class="modal-content">
	           				 <div class="modal-header text-center">
	              				<h5 class="modal-title">'.$this->modal_title.'</h5>
	             				 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
	             				 </button>
            				</div>

            				<div class="modal-body">
			';
						
			$this->form->exibe();
		
			echo '</div>
            </div>
          </div>
        </div>';
		}
		
		
	}


?>