<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EventosModel extends CI_Model {

	public function criarEvento($evento){
		if($this->db->insert('eventos',$evento)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function atualizarEvento($evento){
		$this->db->where('id_evento',$evento['id_evento']);
		if($this->db->update('eventos',$evento)){
			return TRUE;
		}else{
			return FALSE;
		}
		
	}

	public function listarEventos($id_usuario, $is_finalizado){
		$this->db->select('eventos.id_evento, eventos.nome_evento, eventos.carga_horaria_evento, eventos.data_evento, eventos.local_evento, eventos.is_finalizado, eventos.num_participantes, eventos.layout_evento,  responsaveis_evento.nome_responsavel_evento, responsaveis_evento.cargo_responsavel_evento, eventos.id_responsavel_evento');
		$this->db->from('eventos');
		$this->db->join('responsaveis_evento',' eventos.id_responsavel_evento = responsaveis_evento.id_responsavel_evento', 'inner');
		$this->db->where('id_usuario', $id_usuario);
		$this->db->where('is_finalizado', $is_finalizado);
		//realiza consulta e retorna apenas a primeira linha;
		$eventos = $this->db->get()->result_array();
		return $eventos;
	}

	public function consultarEventoPorID($id_evento){
		//condições para a consulta.
		$this->db->select('eventos.id_evento, eventos.nome_evento, eventos.carga_horaria_evento, eventos.data_evento, eventos.local_evento, eventos.is_finalizado, eventos.num_participantes, eventos.layout_evento,  responsaveis_evento.nome_responsavel_evento, responsaveis_evento.cargo_responsavel_evento, eventos.id_responsavel_evento');
		$this->db->from('eventos');
		$this->db->join('responsaveis_evento',' eventos.id_responsavel_evento = responsaveis_evento.id_responsavel_evento', 'inner');
		$this->db->where('id_evento', $id_evento);
		//realiza consulta e retorna apenas a primeira linha;
		$evento = $this->db->get()->row_array();
		return $evento;
	}


	public function encerrarEvento($id_evento){
		$retorno = false;
		$this->db->where('id_evento',$id_evento);
		$this->db->set('is_finalizado', '1');
		if($this->db->update('eventos')){
			$this->db->where('id_evento',$id_evento);
			$this->db->set('certificado_disponivel', '1');
			if($this->db->update('evento_participante')){
				$retorno = true;
			}
		}
		return $retorno;
	}

	/*
	public function retornaUltimoIdEvento(){
		//select id_evento from eventos ORDER by id_evento desc limit 1;
		$this->db->select('id_evento');
		$this->db->order_by('id_evento', 'DESC');
		$ultimoID = $this->db->get("eventos")->row_array();
		return $ultimoID;
	}
	*/
	public function ultimoCadastro(){
		$this->db->select('id_evento');
		return $this->db->get("ultimo_cadastro")->row_array();
	}

	public function atualizaNumeroParticipantes($id_evento, $num_participantes){
		$this->db->where('id_evento', $id_evento);
		$this->db->select('num_participantes');
		$num_atual = $this->db->get("eventos")->row_array();
		$num_atual = implode("", $num_atual);
		$total = $num_atual + $num_participantes;

		$this->db->where('id_evento', $id_evento);
		$this->db->set('num_participantes', $total);
		$this->db->update('eventos');
	}

	public function listarParticipantes($id_evento){
		$this->db->select('id_evento_participante, eventos.nome_evento, evento_participante.id_evento, usuarios.nome_usuario, tipo_participacao');
		$this->db->from('evento_participante');
		$this->db->join('usuarios', 'evento_participante.id_participante = usuarios.id_usuario', 'inner');
		$this->db->join('eventos', 'eventos.id_evento = evento_participante.id_evento', 'inner');
		$this->db->where('evento_participante.id_evento', $id_evento);
		$participantes = $this->db->get()->result_array();
		return $participantes;
	}

	public function removerParticipante($id_participante){
		$this->db->where('id_evento_participante',$id_participante);
		return  $this->db->delete('evento_participante');
	}

	public function consultarEventoPorNome($nome, $encerrado){
		//condições para a consulta.
		$this->db->select('*');
		$this->db->from('eventos');
		$this->db->join('responsaveis_evento', 'eventos.id_responsavel_evento = responsaveis_evento.id_responsavel_evento', 'inner');
		$this->db->like('nome_evento', $nome);
		$this->db->where('is_finalizado', $encerrado);
		//realiza consulta e retorna apenas a primeira linha;
		$eventos = $this->db->get()->result_array();
		return $eventos;
	}	
}