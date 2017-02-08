<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuariosModel extends CI_Model {

	public function criarUsuario($usuario){
		if($this->db->insert('usuarios',$usuario)){
			//$this->db->insert_id();	retorna o ultimo id inserido no bd
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function atualizarUsuario($usuario){
		$this->db->where('id_usuario',$usuario['id_usuario']);
		if($this->db->update('usuarios',$usuario)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function consultarUsuarioCriador($usuario){		
		$this->db->select('usuarios.nome_usuario, usuarios.email_usuario');
		$this->db->from('usuarios');
		$this->db->where('id_usuario', $usuario['id_usuario_criador']);

		$criador = $this->db->get()->row_array();
		return $criador;
	}

	public function consultarUsuarioValido($email_usuario, $senha_usuario){
		//condições para a consulta.
		$this->db->where('email_usuario', $email_usuario);
		$this->db->where('senha_usuario', $senha_usuario);
		//realiza consulta e retorna apenas a primeira linha;
		$usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}

	public function consultarUsuarioPorId($id_usuario){
		//condições para a consulta.
		$this->db->where('id_usuario', $id_usuario);
		//realiza consulta e retorna apenas a primeira linha;
		$usuario = $this->db->get("usuarios")->row_array();
		return $usuario;
	}

	public function consultarUsuarioPorNome($nome){
		//condições para a consulta.
		$this->db->like('nome_usuario', $nome);
		//realiza consulta e retorna apenas a primeira linha;
		$usuarios = $this->db->get("usuarios")->result_array();
		return $usuarios;
	}

	public function existeUsuario($cpf){
		//condições para a consulta.
		$this->db->where('cpf_usuario', $cpf);
		//realiza consulta e retorna apenas a primeira linha;
		$user = $this->db->get("usuarios")->row_array();
		if($user){
			return $user;
		}else{
			return false;
		}
	}

	public function verificarVinculoUsuarioEvento($id_evento, $id_usuario){
		$this->db->select('id_participante');
		$this->db->from('evento_participante');
		$this->db->where('id_participante', $id_usuario);
		$this->db->where('id_evento', $id_evento);
		$result = $this->db->get()->result_array();
		if($result == null){
			return false;
		}else{
			return true;
		}
	}

	public function vincularUsuarioAoEvento($id_usuario, $id_evento, $tipo_participacao){

		if($this->db->query("insert into evento_participante (id_evento, id_participante, tipo_participacao) values ('".$id_evento."','".$id_usuario."', '".$tipo_participacao."')")){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function listarEventosParticipante($id_participante){
		//condições para a consulta.

		$this->db->select('eventos.id_evento, nome_evento, carga_horaria_evento, data_evento, local_evento, responsaveis_evento.nome_responsavel_evento, responsaveis_evento.cargo_responsavel_evento, responsaveis_evento.assinatura_responsavel_evento, tipo_participacao');
		$this->db->from('evento_participante');
		$this->db->join('eventos', 'evento_participante.id_evento = eventos.id_evento', 'inner');
		$this->db->join('responsaveis_evento', 'responsaveis_evento.id_responsavel_evento = eventos.id_responsavel_evento', 'inner');
		$this->db->where('id_participante', $id_participante);
		$this->db->where('certificado_disponivel', 1);
		$eventos = $this->db->get()->result_array();
		return $eventos;
	}


	public function listarUsuarios($tipo_usuario, $id_usuario){
		if($tipo_usuario == 1){
			$usuarios = $this->db->get("usuarios")->result_array();
		}else{
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->where('id_usuario_criador', $id_usuario);
			$usuarios = $this->db->get()->result_array();
		}
		return $usuarios;
	}

	public function atualizarSenha($id_usuario, $nova_senha){
		$this->db->set('senha_usuario', $nova_senha);
		$this->db->where('id_usuario',$id_usuario);
		if($this->db->update('usuarios')){	
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function excluirUsuario($id_usuario, $tipo_usuario){
		$exclusao = false;
		if($tipo_usuario == '3'){
			$this->db->select('id_participante');
			$this->db->from('evento_participante');
			$this->db->where('id_participante', $id_usuario);
			$user = $this->db->get()->row_array();
			if($user == null){
				$this->db->where('id_usuario',$id_usuario);
				$this->db->delete('usuarios');
				$exclusao = true;
			}
		}else{
			$this->db->select('id_usuario');
			$this->db->from('eventos');
			$this->db->where('id_usuario', $id_usuario);
			$user = $this->db->get()->row_array();
			if($user == null){
				$this->db->where('id_usuario',$id_usuario);
				$this->db->delete('usuarios');
				$exclusao = true;
			}
		}
		return $exclusao;
	}

}
