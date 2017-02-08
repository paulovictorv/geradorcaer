<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ResponsaveisController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('ResponsaveisModel');
	}



	public function listarResponsaveis(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$responsaveis = $this->ResponsaveisModel->listarResponsaveis();
			$dadosResponsaveis = array("responsaveis" => $responsaveis);
			
			if ($dadosResponsaveis){
				$this->load->template('responsaveis/lista_de_responsaveis',$usuarioLogado, $dadosResponsaveis);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function novoResponsavel(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('responsaveis/novo_responsavel',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function criarResponsavel(){
		if(esta_logado()){
			$responsavel = $this->input->post('responsaveis_evento');
			$assinatura_responsavel = $_FILES['assinatura_responsavel_evento'];
			$id_usuario_criador = $this->session->userdata("usuario_logado")['usuario']['id_usuario'];
			$nome_imagem = padronizarNomeImagem($assinatura_responsavel, $id_usuario_criador);
		    $configuracao = array(
		        'upload_path'   => './uploads/',
		        'allowed_types' => 'jpg|jpeg|png',
		        'file_name'     => ''.$nome_imagem
		     );  

		    $this->upload->initialize($configuracao);
		    if (!$this->upload->do_upload('assinatura_responsavel_evento')){
		        echo $this->upload->display_errors();
		    }
		   	$responsavel_evento = array(
				"nome_responsavel_evento" => $responsavel['nome_responsavel_evento'],
				"cargo_responsavel_evento" => $responsavel['cargo_responsavel_evento'],
				"id_usuario_criador" => $responsavel['id_usuario_criador'],
				"assinatura_responsavel_evento" => ''.$nome_imagem
			);
			if($this->ResponsaveisModel->criarResponsavel($responsavel_evento)) {
				$this->session->set_flashdata("success", "Responsavel criado com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao criar Responsavel!");
			}
			redirect("listar-responsaveis");
		}else{
			redirect("/");
		}
	}

	public function editarResponsavel(){
		if(esta_logado()){
			$id = $this->input->post('responsaveis_evento[id_responsavel_evento]');
			$responsavel = $this->ResponsaveisModel->consultarResponsavelPorID($id);
			$responsavel = array('responsavel' => $responsavel);
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$this->load->template('responsaveis/editar_responsavel',$usuarioLogado, $responsavel);
		}else{
			redirect("/");
		}
	}

	public function atualizarResponsavel(){
		if(esta_logado()){
			$erro = false; // variavel para guardar um evento de erro.
			$responsavel = $this->input->post('responsaveis_evento'); // recebe os dados (via post) do responsavel que deverão ser atualizados   
			$id = $this->input->post('id_responsavel_evento');

			$assinatura_responsavel = $_FILES['assinatura_responsavel_evento']; // armazena as informações da imagem enviada
			if($assinatura_responsavel['error']==0){ // caso alguma imagem tenha sido enviada entra aqui
				$id_usuario_criador = $this->session->userdata("usuario_logado")['usuario']['id_usuario'];
				$nome_imagem = padronizarNomeImagem($assinatura_responsavel, $id_usuario_criador); //função para padronizar nome img 
			    $configuracao = array(
			        'upload_path'   => './uploads/', // local onde será salvo
			        'allowed_types' => 'jpg|jpeg|png', // formatos aceitos
			        'file_name'     => ''.$nome_imagem // nome que será dado a imagem
			    );  
			    $responsavel_antigo = $this->ResponsaveisModel->consultarResponsavelPorID($id); //pega os dados do responsavel do bd
			    $this->upload->initialize($configuracao); //informa a função upload quais os requisistos para validar.
			    if (!$this->upload->do_upload('assinatura_responsavel_evento')){ // caso dê erro no upload entra aqui
			    	$mensagem_erro = strip_tags($this->upload->display_errors()); // grava mensagem de erro.
			        $this->session->set_flashdata("danger", $mensagem_erro); // mostra na tela mensagem com flash data.
			        $erro = true;  // altera a variavel para true pois ocorreu erro.
			    }else{ // caso o upload seja bem sucedido entra aaqui
				   	unlink("./uploads/".$responsavel_antigo['assinatura_responsavel_evento']); // deleta a imagem antiga
			    	$nome_imagem = redimensionaTamanhoImagem($nome_imagem);// redimensiona a imagem no tamanho correto
				   	$responsavel = array( // atribui todos os dados que vieram da view juntamentente com a imagem upada
						"nome_responsavel_evento" => $responsavel['nome_responsavel_evento'],
						"cargo_responsavel_evento" => $responsavel['cargo_responsavel_evento'],
						"id_usuario_criador" => $responsavel['id_usuario_criador'],
						"assinatura_responsavel_evento" => ''.$nome_imagem
					);
			    }
			}
			if($erro == false){ // caso não tenha ocorrido nenhum erro entra aqui para atualizar o evento no bd
			    if ($this->ResponsaveisModel->atualizarResponsavel($responsavel, $id)) { // efetua a alteração no bd
					$this->session->set_flashdata("success", "Responsavel alterado com sucesso!"); // caso algo dê certo mostra mensagem
				}else{
					$this->session->set_flashdata("danger", "Erro ao alterar os dados do Responsavel!"); // caso algo dê errado monstra erro
				}
			}
			redirect("listar-responsaveis");
		}else{
			redirect("/");
		}
	}

	public function excluirResponsavel(){
		if(esta_logado()){
			$id = $this->input->post('id_responsavel_evento');
			if ($this->ResponsaveisModel->excluirResponsavel($id)) {
				$this->session->set_flashdata("success", "Responsavel excluido com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Responsavel não pode ser removido pois esta vinculado a algum evento!");
			}
			redirect("listar-responsaveis");
		}else{
			redirect("/");
		}
	}

	public function pesquisarResponsavel(){
		if(esta_logado()){
			$nome_informado = $this->input->post('nome_informado');
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$resultado = $this->ResponsaveisModel->consultarResponsavelPorNome($nome_informado);
			$dadosResponsaveis = array("responsaveis" => $resultado);
			if ($dadosResponsaveis){
				$this->load->template('responsaveis/lista_de_responsaveis',$usuarioLogado, $dadosResponsaveis);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

}
?>
