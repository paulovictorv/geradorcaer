<?php	
	function padronizarNomeImagem($dados_imagem, $id_usuario_criador){
		$numAleatorio1 = rand();
		$numAleatorio2 = rand();
		$id = $id_usuario_criador;
		//img_'.$evento['id_evento'].'_'.$numAleatorio
		$partes = explode("/",$dados_imagem['type']);
		if($partes[1] == "jpeg"){
			$partes[1] = "jpg";
			return 'jpeg_img_'.$numAleatorio1.'_'.$numAleatorio2.'_'.$id.'.'.$partes[1];
		}else{
			return 'normal_img_'.$numAleatorio1.'_'.$numAleatorio2.'_'.$id.'.'.$partes[1];
		}
	}

	function ajustaFormatoParaJpeg($nome_imagem){
		$partes = explode("_",$nome_imagem);
		if($partes[0] == "jpeg"){
			$formato = explode(".", $partes[3]);
			$nome_final = "{$partes[0]}_{$partes[1]}_{$partes[2]}_{$formato[0]}.jpeg";
			return $nome_final;
		}else{
			return $nome_imagem;
		}
	}

	function redimensionaTamanhoImagem($nome_imagem){
		$partes = explode("_",$nome_imagem);
		var_dump($partes);
		$formato= explode(".", $partes[4]);
		$img = wideImage::load('./uploads/'.$nome_imagem);
		$resized = $img->resize(700, 400);
		$resized->saveToFile("./uploads/".$partes[0]."_".$partes[1]."_".$partes[2]."_".$partes[3]."_".$formato[0].".".$formato[1]);
		return $partes[0]."_".$partes[1]."_".$partes[2]."_".$partes[3]."_".$formato[0].".".$formato[1];
	}