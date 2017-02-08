<?php	



	function validaDadosPlanilha($dados){

		$validado = true;
		
		try 
		{
		    foreach($dados as $dado){
		    	$tamanho_linha = count($dado);
		    	if($tamanho_linha < 4){
		    		$validado = false;
		    		break;
		    	}else{	    				    	
					if($dado['A'] == null){
						$validado = false;
					}

					if($dado['B'] == null){
						$validado = false;
					}

					$tamanho = strlen($dado['C']);
					if($tamanho != 11){
						$validado = false;
					}

					if($dado['D'] == null){
						$validado = false;
					}
				
		    	}
			}
		} catch (Exception $e) {
		    $validado = false;
		}
		return $validado;
	}