<?php
	function formataCPF($cpf){
        $cpfFormtado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
		return $cpfFormtado;
	}

	function removeMascaraCPF($cpf){
		$partes1 = explode(".",$cpf);
		$partes2 = explode("-",$partes1[2]);
		$cpf = "{$partes1[0]}{$partes1[1]}{$partes2[0]}{$partes2[1]}";
		return $cpf;
	}



	