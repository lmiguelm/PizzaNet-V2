<?php

	class Tabela implements Exibicao{
		
		private $matriz;
		private $alterar;
		private $remover;
		private $tabela;
		
		public function __construct($matriz,$tabela,$alterar,$remover){			
				$this->matriz = $matriz;
				$this->alterar = $alterar;
				$this->remover = $remover;
				$this->tabela = $tabela;
		}
		
		
		public function exibe(){
				
			echo "
				<div class='container'>
					<div class='table-responsive'>
						<table class='table table-sm table-hover table-dark text-center'>";	
			
					if($this->matriz!=null){
						foreach($this->matriz as $i=>$linha){		
							
							if($i==0){
								
								echo "
								<thead>
								<tr class='text-center'>";
								foreach($linha as $j=>$valor){					
									if(!is_numeric($j)){
										echo "<th>$j</th>";
									}
								}
								
								if($this->remover!=null || $this->alterar!=null || $this->tabela=='pedido'){
									echo "<th>Ação</th>";
								}
								
								echo "</tr>
									  </thead>
									  <tbody id='$this->tabela'>";
							}
							
							echo "<tr class='text-center'>";
							foreach($linha as $j=>$valor){					
								if(!is_numeric($j)){
									echo "<td class='$j'>$valor</td>";
								}
							}
							if($this->remover!=null || $this->alterar!=null){
								echo "<th>";
									if($this->alterar!=null){
										if($this->tabela!='cliente'){
											echo "<i class='material-icons text-warning alterar_$this->tabela' data-toggle='tooltip' title='' data-original-title='Editar'>edit</i> ";
										}
										else{
											echo "<i class='material-icons text-warning alterar_$this->tabela'>edit</i> ";
										}
										
									}

									
									if($this->remover!=null){
										echo " <a  class='material-icons text-danger'href='remover.php?tabela=$this->tabela&id=$linha[0]' data-toggle='tooltip' title='' data-original-title='Remover'>delete</a>";
									}
								echo "</th>";							
							}
							echo "</tr>";					
						}
					}
			echo "		</tbody>
					</table>
				</div>
			</div>";
		}		
	}

?>
