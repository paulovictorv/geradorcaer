<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UsuariosController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UsuariosModel');
		$this->load->model('EventosModel');
	}

	public function index(){
		$usuarioLogado = $this->session->userdata("usuario_logado");
		$eventos = $this->EventosModel->listarEventos($usuarioLogado["usuario"]["id_usuario"], 0);
		$dadosEventos = array("eventos" => $eventos);
		$this->load->template('login/home',$usuarioLogado, $dadosEventos);
	}

	public function visualizarPerfil(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('usuarios/perfil_usuario',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function editarPerfil(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('usuarios/editar_perfil',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function editarUsuario(){
		if(esta_logado()){
			$id = $this->input->post('usuario[id_usuario]');
			$user = $this->UsuariosModel->consultarUsuarioPorID($id);
			$user = array('user' => $user);
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$this->load->template('usuarios/editar_usuario',$usuarioLogado, $user);
		}else{
			redirect("/");
		}
	}

	public function atualizarUsuario(){
		if(esta_logado()){
			if ($this->UsuariosModel->atualizarUsuario($this->input->post('usuario'))) {
				//$user = $this->UsuariosModel->consultarUsuarioPorID($this->input->post('usuario[id_usuario]'));
				$this->session->set_flashdata("success", "Usuario alterado com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao alterar os dados do usuario!");
			}
			//$user = array('user' => $user);
			$usuarioLogado = $this->session->userdata("usuario_logado");
			redirect("listar-usuarios");
		}else{
			redirect("/");
		}
	}

	public function excluirUsuario(){
		if(esta_logado()){
			$id = $this->input->post('usuario[id_usuario]');
			$tipo_usuario = $this->input->post('usuario[tipo_usuario]');
			if ($this->UsuariosModel->excluirUsuario($id, $tipo_usuario)) {
				$this->session->set_flashdata("success", "Usuario excluido com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Usuario não pode ser removido pois esta vinculado a algum evento!");
			}
			redirect("listar-usuarios");
		}else{
			redirect("/");
		}
	}

	public function atualizarPerfil(){
		if(esta_logado()){
			$usuario = $this->session->userdata("usuario_logado");
			if ($this->UsuariosModel->atualizarUsuario($this->input->post('usuario'))) {
				$usuario = $this->UsuariosModel->consultarUsuarioPorID($this->input->post('usuario[id_usuario]'));
				$usuario = array("usuario" => $usuario);
				$this->session->set_userdata("usuario_logado", $usuario);
				$this->session->set_flashdata("success", "Dados alterados com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao alterar os dados!");
			}
			$this->load->template('usuarios/perfil_usuario',$usuario);
		}else{
			redirect("/");
		}
	}


	public function novoUsuario(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('usuarios/novo_usuario',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function criarUsuario(){
		if(esta_logado()){
			$usuario = $this->input->post('usuario');
			$usuario['senha_usuario'] = hash('sha512', removeMascaraCPF($usuario["cpf_usuario"]));
			$usuario['id_usuario_criador'] = $this->session->userdata("usuario_logado")['usuario']['id_usuario'];
			// implementar função que retira mascara do cpf para poder gerar a senha.
			
			if($this->UsuariosModel->criarUsuario($usuario)) {
				$this->session->set_flashdata("success", "Usuário criado com sucesso!");
			}else{
				$this->session->set_flashdata("danger", "Erro ao criar usuário!");
			}
			redirect("listar-usuarios");
		}else{
			redirect("/");
		}
	}

	public function listarUsuarios(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$usuarios = $this->UsuariosModel->listarUsuarios($usuarioLogado['usuario']['tipo_usuario'], $usuarioLogado['usuario']['id_usuario']);
			$dadosUsuarios = array("usuarios" => $usuarios);
			
			if ($dadosUsuarios){
				$this->load->template('usuarios/lista_de_usuarios',$usuarioLogado, $dadosUsuarios);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function alterarSenha(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('usuarios/alterar_senha',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function atualizarSenha(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$senha_atual = hash('sha512', $this->input->post('senha_atual'));
			$nova_senha = $this->input->post('nova_senha');
			$confirmacao_nova_senha = $this->input->post('confirmacao_nova_senha');
			
			if(($senha_atual == $usuarioLogado['usuario']['senha_usuario']) && ($nova_senha == $confirmacao_nova_senha)){
				$nova_senha = hash('sha512', $nova_senha);
				if($this->UsuariosModel->atualizarSenha($usuarioLogado['usuario']['id_usuario'], $nova_senha)){
					$this->session->set_flashdata("success", "Senha atualizada com sucesso!");			
					$usuarioLogado['usuario']['senha_usuario'] = $nova_senha;
					$this->session->set_userdata("usuario_logado", $usuarioLogado);
				}else{
					$this->session->set_flashdata("danger", "Ocorreu um erro ao atualizar a senha!");
				}
				
			}else{
				$this->session->set_flashdata("danger", "As senhas não conferem!");

			}
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$this->load->template('usuarios/alterar_senha',$usuarioLogado);
		}else{
			redirect("/");
		}
	}

	public function pesquisarUsuario(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			$nome_informado = $this->input->post('nome_informado');
			$resultado = $this->UsuariosModel->consultarUsuarioPorNome($nome_informado);
			$dadosUsuarios = array("usuarios" => $resultado);
			if ($dadosUsuarios){
				$this->load->template('usuarios/lista_de_usuarios',$usuarioLogado, $dadosUsuarios);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}



	public function solicitarAlteracaoDados(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$this->load->template('usuarios/solicitacao_alteracao_dados',$usuarioLogado);
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}


	public function enviarSolicitacao(){
		if(esta_logado()){
			$usuarioLogado = $this->session->userdata("usuario_logado");
			if($usuarioLogado){
				$criador = $this->UsuariosModel->consultarUsuarioCriador($usuarioLogado['usuario']);
				//configuração para envido de emails..
				$this->load->library("email");
				$config["protocol"] ="smtp";
				$config["smtp_host"] = "ssl://smtp.gmail.com";
				$config["smtp_user"]= "meucertificadoweb@gmail.com";
				$config["smtp_pass"] = "";
				$config["charset"] = "utf-8";
				$config["mailtype"] = "html";
				$config["newline"] = "\r\n";
				$config["smtp_port"] = "465";

				$solicitacao = $this->input->post('solicitacao');
				
				$this->email->from("meucertificadoweb@gmail.com", "Meu Certificado");
				$this->email->to(array($criador['email_usuario']));
				$this->email->subject("Solicitação de Alteração de Dados.");// Assunto
				$this->email->message('Olá, você recebeu este email porque o usuário '.$usuarioLogado['usuario']['nome_usuario'].' solicitou alteração de alguns dados, segue a mensagem abaixo: <br> <br> "'.$solicitacao.'" <br> <br> Para efetuar a alteração solicitada, faça login no sistema Meu certificado e procure o no menu de usuário pelo nome do solicitante. Por favor não responsa este email!'); // mensagem do email
				if($this->email->send()){
					$this->session->set_flashdata("success", "Solicitação enviada, aguarde a verificação!");
				}else{
					$this->session->set_flashdata("danger", "Erro ao tentar enviar a solicitacão, tente novamente em alguns instantes!");
				}

				redirect("visualizar-perfil");
				
			}else{
				show_error("Ocorreu algum erro!");
			}
		}else{
			redirect("/");
		}
	}

	public function geraJSON(){
		$dados = $this->UsuariosModel->listarUsuarios();
		//var_dump($dados);
		$dados = array('dados' => $dados);
		header('Content-Type: application/json');
		$dados = json_encode($dados);
		echo($dados);
	}

	public function login(){
		header('Content-Type:' . "text/plain");
		$data = json_decode(file_get_contents("php://input"));

  		$email = $data -> email_usuario;
  		$senha = $data -> senha_usuario;

		$senha = hash('sha512', $senha);

		$usuario = $this->UsuariosModel->consultarUsuarioValido($email, $senha);
		if($usuario){
			if($usuario['tipo_usuario'] == '3'){
				$user[0] = array(
					"id_usuario" => $usuario['id_usuario'],
					"nome_usuario" => $usuario['nome_usuario'],
					"email_usuario" => $usuario['email_usuario'],
					"cpf_usuario" => $usuario['cpf_usuario'],
					"senha_usuario" => $usuario['senha_usuario'],
					"tipo_usuario" => $usuario['tipo_usuario'],
					"valido" => true,
					"user" => false
				);
			}else{
				$user[0] = array(
					"valido" => false,
					"user" => true
				);
			}
		}else{
			$user[0] = array(
					"valido" => false,
					"user" => false
			);
		}

		/*
		$user[0] = array(
				//"nome_usuario" => $nome,
				"email_usuario" => $email,
				//"cpf_usuario" => $cpf,
				"senha_usuario" => $senha
				//"tipo_usuario" => $tipo_usuario
			);
		*/
		$user = array('dados' => $user);

		$dados = json_encode($user);
		echo($dados);

	}

	public function gerarCertificado(){

		if(esta_logado()){
			define('PDF/FPDF_FONTPATH','fpdf/font/');
			$pdf = new FPDF('L','mm','A4');
			$pdf->AddPage();
			
			$pdf->Image("./uploads/fundo_certificado.jpg", 0,0,297,210);

			$pdf->SetFont('Arial','B',30);
			$pdf->SetY("45");
			$pdf->SetX("112"); 
			$pdf->Cell(90,50,'ATESTADO',0,0,'C'); 

			$usuario = $this->session->userdata("usuario_logado");
		    $nomeEvento = $this->input->post('evento[nome_evento]');
		    $dataEvento = converteParaPtBr($this->input->post('evento[data_evento]'));
		    $dataExtenso = converteParaExtenso($dataEvento);
		    $localEvento = $this->input->post('evento[local_evento]');
		    $cargaHorariaEvento = $this->input->post('evento[carga_horaria_evento]');
		    $tipoParticipacao = $this->input->post('evento[tipo_participacao]');
		    $assinaturaResponsavel = $this->input->post('evento[assinatura_responsavel_evento]');
		    $responsavelEvento = $this->input->post('evento[responsavel_evento]');
		    $cargoResponsavelEvento = $this->input->post('evento[cargo_responsavel_evento]');


		    $pdf->SetFont('Arial','B',16);
		    $texto = utf8_decode('        Atestamos para os devidos fins que '.$usuario['usuario']['nome_usuario'].' participou como '.$tipoParticipacao.' do evento '.$nomeEvento.' realizado no dia '.$dataExtenso.' no local '.$localEvento.' perfazendo um total de '.$cargaHorariaEvento.' horas.');

		    $pdf->SetY("90");
			//posiciona horizontalmente 10mm
			$pdf->SetX("40"); 
			//escreve o conteudo de novo.. parametros posicao inicial,altura,conteudo(*texto),borda,quebra de linha,alinhamento
			$pdf->MultiCell(220,9,$texto,0,'J');


			//Celula para qrcode
			$pdf->SetY("130");
			$pdf->SetX("60"); 
			$this->load->library('QrCode/phpqrcode/qrlib');
			$img_qrcode = "qrcode.png";
			QRcode::png('Validação de Certificado! Segue texto original:
				Atestamos para os devidos fins que '.$usuario['usuario']['nome_usuario'].' participou como '.$tipoParticipacao.' do evento '.$nomeEvento.' realizado no dia '.$dataExtenso.' no local '.$localEvento.' perfazendo um total de '.$cargaHorariaEvento.' horas.' , 'uploads/'.$img_qrcode);
			$pdf->Cell(0,5,'',0,0,'L');
			$pdf->Image("./uploads/".$img_qrcode, 50,130,40,40);


			//Celula para data atual
		    $dataAtual = date("d/m/Y");
		    $dataAtual = converteParaExtenso($dataAtual);
			$pdf->SetY("135");
			$pdf->SetX("185"); 
			$pdf->Cell(0,5,'Torres, '.$dataAtual.'.',0,0,'L'); 
		    

			//$nome_imagem = ajustaFormatoParaJpeg($assinaturaResponsavel);
			//Celula onde irá a imagem da assinatura do Responsável
			$pdf->Image("./uploads/".$assinaturaResponsavel, 118,145,60,30);

			//Celula da barra onde vai a assinatura do Responsável
			$pdf->SetY("160");
			$pdf->Cell(0,5,'_________________________________',0,0,'C'); 


			//Celula do nome do Responsável pelo evento
			$pdf->SetY("168");
			$pdf->Cell(0,5,$responsavelEvento,0,0,'C');

			//Celula do cargo do Responsável pelo evento
			$pdf->SetY("176");
			$pdf->Cell(0,5,$cargoResponsavelEvento,0,0,'C');

			$pdf->Output('Certificado.pdf','I');
		}else{
			redirect("/");
		}
	}

}
?>
