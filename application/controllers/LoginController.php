<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('UsuariosModel');
		$this->load->model('EventosModel');
	}

	public function index(){
		$this->load->view('login/login');
	}	

	public function validaLogin(){
		$email = $this->input->post('email');
		$senha = hash('sha512', $this->input->post('senha'));
		var_dump($senha);
		$usuario = $this->UsuariosModel->consultarUsuarioValido($email, $senha);
		if($usuario){
			$usuario = array("usuario" => $usuario);
			//guarda na session o usuario que fez login
			$this->session->set_userdata("usuario_logado", $usuario);
			redirect("home");
		}else{
			$this->session->set_flashdata("danger", "Usuário ou senha inválido");
			redirect("/"); // redireciona para a pagina padrao;	
		}
		
	}

	public function home(){
		if(esta_logado()){
			$usuario = $this->session->userdata("usuario_logado");
			if($usuario["usuario"]["tipo_usuario"] == 3){
				$eventos = $this->UsuariosModel->listarEventosParticipante($usuario["usuario"]["id_usuario"]);
				$dadosEventos = array("eventos" => $eventos);
			}else{
				$eventos = $this->EventosModel->listarEventos($usuario["usuario"]["id_usuario"],0);
				$dadosEventos = array("eventos" => $eventos);
			}
			$this->load->template('login/home',$usuario, $dadosEventos);
		}else{
			redirect("/");
		}
		
	}

	public function fazerLogoff(){
		$this->session->unset_userdata("usuario_logado"); 
		$this->session->set_flashdata("success", "Você saiu do sistema!");
		redirect("/");
	}

}

?>
