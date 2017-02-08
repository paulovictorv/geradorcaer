<?php
	function converteParaMysql($dataPtBr){
		$partes = explode("/", $dataPtBr);
		return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
	}

	function converteParaPtBr($dataMysql){
		$data = new DateTime($dataMysql);
		return $data->format("d/m/Y");
	}

	function converteParaExtenso($dataFormatada){
		$partes = explode("/", $dataFormatada);
		$mes = "";
		switch ($partes[1]) {
		    case "01":
		        $mes = "Janeiro";
		        break;
		    case "02":
		        $mes = "Fevereiro";
		        break;
		    case "03":
		        $mes = "Março";
		        break;
		    case "04":
		        $mes = "Abril";
		        break;
		    case "05":
		        $mes = "Maio";
		        break;
		    case "06":
		        $mes = "Junho";
		        break;
		    case "07":
		        $mes = "Julho";
		        break;
		    case "08":
		        $mes = "Agosto";
		        break;
		    case "09":
		        $mes = "Setembro";
		        break;
		    case "10":
		        $mes = "Outubro";
		        break;
		    case "11":
		        $mes = "Novembro";
		        break;
		    case "12":
		        $mes = "Dezembro";
		        break;
		}
		return "{$partes[0]} de {$mes} de {$partes[2]}";
	}