<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventosController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('EventosModel');
		$this->load->model('UsuariosModel');
		$this->load->model('ResponsaveisModel');
	}


	public function novoEvento(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$responsaveis = $this->ResponsaveisModel->listarResponsaveis();
			$responsaveis = array('responsaveis'=> $responsaveis);
			if($usuarioLogado){
				$this->load->template('eventos/novo_evento',$usuarioLogado, $responsaveis);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function criarEvento(){
		if(esta_logado()){
			$evento = $this->input->post('evento');

            $layout = $_FILES['layout_evento'];
            $id_usuario_criador = $this->session->userdata("usuario_logado")['usuario']['id_usuario'];
            $nome_imagem = padronizarNomeImagem($layout, $id_usuario_criador);
            $configuracao = array(
                'upload_path'   => './uploads/',
                'allowed_types' => 'jpg|jpeg|png',
                'file_name'     => ''.$nome_imagem
            );

            $this->upload->initialize($configuracao);

            if (!$this->upload->do_upload('layout_evento')){
                echo $this->upload->display_errors();
            }

            $evento["layout_evento"] = ''.$nome_imagem;

			if ($this->EventosModel->criarEvento($evento)) {
				$this->session->set_flashdata("success", "Evento criado com sucesso!");
				$id_evento_criado = $this->db->insert_id(); // retorna o ultimo id inserido;
				$this->detalharEvento($id_evento_criado);
			}else{
				$this->session->set_flashdata("danger", "Ocorreu um erro ao criar o evento!");
				redirect("novo-evento");
			}
		}else{
			redirect("/");
		}
	}

	public function editarEvento(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$evento = $this->EventosModel->consultarEventoPorID($this->input->post('evento[id_evento]'));
			$responsaveis = $this->ResponsaveisModel->listarResponsaveis();
			$dadosEvento[0] = $evento;
			$dadosEvento[1] = $responsaveis;
			$dadosEvento = array("evento" => $dadosEvento);
			if($usuarioLogado){
				$this->load->template('eventos/editar_evento',$usuarioLogado, $dadosEvento);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}
	public function atualizarEvento(){
		if(esta_logado()){
			$evento = $this->input->post('evento'); // recebe os dados (via post) do evento que deverão ser atualizados   
		    if ($this->EventosModel->atualizarEvento($evento)) { // efetua a alteração no bd
				$this->session->set_flashdata("success", "Evento atualizado com sucesso!"); // caso algo dê certo mostra mensagem
			}else{
				$this->session->set_flashdata("danger", "Erro ao atualizar evento!"); // caso algo dê errado monstra erro
			}
			$this->detalharEvento(); // chama a view de detalhes do evento
		}else{
			redirect("/");
		}
	}

	public function listarEventosEncerrados(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$eventos = $this->EventosModel->listarEventos($usuarioLogado["usuario"]["id_usuario"],1);
			$dadosEventos = array("eventos" => $eventos);
			if ($dadosEventos){
				$this->load->template('eventos/eventos_encerrados',$usuarioLogado, $dadosEventos);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function detalharEvento($id_evento =""){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$id = $this->input->post('evento[id_evento]');
			if($id == null){
				$id = $id_evento;
			}
			$evento = $this->EventosModel->consultarEventoPorID($id);
			$dadosEvento = array("evento" => $evento);
			if ($dadosEvento){
				//var_dump($dadosEvento);
				$this->load->template('eventos/detalhes_evento',$usuarioLogado, $dadosEvento);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function listarParticipantes(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$id_evento = $this->input->post('evento[id_evento]');
			$participantes = $this->EventosModel->listarParticipantes($id_evento);
			$participantes = array("participantes" => $participantes);
			if ($participantes){
				$this->load->template('eventos/participantes_evento',$usuarioLogado, $participantes);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function removerParticipante(){

		if(esta_logado()){
			$id_participante = $this->input->post('evento[id_participante]');

			if ($this->EventosModel->removerParticipante($id_participante)) {
				$this->session->set_flashdata("success", "Participante Removido com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao remover participante!");
			}
			$this->listarParticipantes();
		}else{
			redirect("/");
		}
	}

	public function encerrarEvento(){
		if(esta_logado()){
			$id_evento = $this->input->post('evento[id_evento]');
			if ($this->EventosModel->encerrarEvento($id_evento)) {
				$this->session->set_flashdata("success", "Evento encerrado com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao encerrar evento!");
			}
			$this->detalharEvento($id_evento);
		}else{
			redirect("/");
		}
	}

	public function pesquisarEvento(){
		if(esta_logado()){
			$nome_informado = $this->input->post('nome_informado');
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$resultado = $this->EventosModel->consultarEventoPorNome($nome_informado, 1);
			$dadosResponsaveis = array("eventos" => $resultado);
			if ($dadosResponsaveis){
				$this->load->template('eventos/eventos_encerrados',$usuarioLogado, $dadosResponsaveis);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function processarPlanilha(){
		if(esta_logado()){
			$erro = false; // variavel para guardar um evento de erro.
			$id_evento = $this->input->post('id_evento'); // pega id do evento
			try{
				$planilha = $_FILES['planilha']; // le o arquivo que foi upado pelo usuário
						// configuração do upload.
			    $configuracao = array(
			        'upload_path'   => './uploads/',// diretorio onde o arquivo será salvo
			        'allowed_types' => 'xlsx|xls', // formatos aceitos
			        'file_name'     => $planilha['name'], // nome da planilha.
			    );      

			    // faz o upload da planilha..
			    $this->upload->initialize($configuracao);
			    if (!$this->upload->do_upload('planilha')){ // caso ocorrra erro no upload entra aqui...
			    	$mensagem_erro = strip_tags($this->upload->display_errors());// armazena na variavel o erro
			    	$this->session->set_flashdata("danger", $mensagem_erro); // mostra o erro na tela
			    	$erro = true; // guarda evento de erro.
			    }else{ // caso upload seja bem sucedido entra aqui
				   	$fileName = "./uploads/".$planilha['name']; // pega o caminho do arquivo.
				   	
				   	$dadosPlanilha = $this->lerPlanilha($fileName); // chama a função para pegar os dados da planilha
				   	if($dadosPlanilha){ // caso existam dados entra aqui
				   		$this->vincularUsuarioAoEvento($dadosPlanilha, $fileName, $id_evento); //chama a função vincular usuarios ao evento
				   	}else{ // caso não tenha nada na planinha entra aqui
				   		$this->session->set_flashdata("danger", "Não foi possível ler a planilha"); // mostra mensagem de erro.
				   		$erro = true;//guarda evento de erro.
				   		//unlink($fileName);
				   	}
			    }
			}catch(Exception $e){
				$erro = true;
			}
			
		    if($erro == true){ // caso tenha evento de erro entra aqui
		    	$this->session->set_flashdata("danger", "Não foi possível ler a planilha");
		    	$this->detalharEvento($id_evento);	// mostra mensagem com o erro que ocorreu.
		    }
		}else{
			redirect("/");
		}
	}

	public function lerPlanilha($fileName){
		$erro = false;
		try {
			$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);

			$excelObj = $excelReader->load($fileName);
			//Pega os nomes das abas
			$worksheetNames = $excelObj->getSheetNames($fileName);
			$return = array();

			foreach($worksheetNames as $key => $sheetName){  
				//define a aba ativa
				$excelObj->setActiveSheetIndexByName($sheetName);
				//cria um array com o nome da aba como índice
				$return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
			}
		} catch (Exception $e) {
			$erro = true;
		}
		
		if($erro == false){
			return $dadosPlanilha = $return[$sheetName];// retorna os dados da planilha..
		}
	}

	public function vincularUsuarioAoEvento($dadosPlanilha, $fileName, $id_evento){
		unset($dadosPlanilha[1]); // remove primeira linha da planilha
		$erro = false;
		if(validaDadosPlanilha($dadosPlanilha)){
			try {
				foreach($dadosPlanilha as $dados){ // percore o array gerado da planilha
					$cpf = formataCPF($dados['C']);// formata cpf com a mascara
					$usuario = $this->UsuariosModel->existeUsuario($cpf); // verifica se já existe um usuário com este cpf
					if($usuario){
						if($this->UsuariosModel->verificarVinculoUsuarioEvento($id_evento, $usuario['id_usuario']) == false){
							if(!$this->UsuariosModel->vincularUsuarioAoEvento($usuario['id_usuario'], $id_evento, $dados['D'])){
								$this->session->set_flashdata("danger", "Erro ao Vincular Aluno ao Evento");
								$erro = true;
							}
						}
					}else{
						// caso não exista é criado um usuário para o participante
						$user = array(
						    "senha_usuario" => hash('sha512', $dados['C']),
						    "nome_usuario" => $dados['A'],
						    "cpf_usuario" =>  $cpf,
						    "email_usuario" => $dados['B'],
						    "tipo_usuario" => "3",
						    "id_usuario_criador" => $this->session->userdata("usuario_logado")['usuario']['id_usuario']
						);		
						// cria usuário no bd
						
						if(!$this->UsuariosModel->criarUsuario($user)){
							$this->session->set_flashdata("danger", "Erro ao criar usuario");
						}else{
							// depois é inserido na table participantes_evento
							$user = $this->UsuariosModel->existeUsuario($user['cpf_usuario']);
							if(!$this->UsuariosModel->vincularUsuarioAoEvento($user['id_usuario'], $id_evento, $dados['D'])){
								$this->session->set_flashdata("danger", "Erro ao Vincular Aluno ao Evento");
								$erro -true;
							}
						}
						
					}
				}			
			} catch (Exception $e) {
				$erro = true;
				$this->session->set_flashdata("danger", "Erro ao processar os dados da Planilha");
			}
		}else{
			$this->session->set_flashdata("danger", "Existem dados incompletos na planilha");
			$erro = true;
		}	

		if($erro == false){
			$this->session->set_flashdata("success", "Dados Importados com sucesso");
		}
		//deleta o arquivo
		unlink($fileName);
		//redireciona para a pagina do evento.
		$this->detalharEvento($id_evento);		
	}

}
?>