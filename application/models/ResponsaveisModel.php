<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ResponsaveisModel extends CI_Model {

	public function criarResponsavel($responsavel){
		return $this->db->insert('responsaveis_evento',$responsavel);
		//$this->db->insert_id();	retorna o ultimo id inserido no bd
	}

	public function atualizarResponsavel($responsavel, $id_responsavel){
		$this->db->where('id_responsavel_evento',$id_responsavel);
		return $this->db->update('responsaveis_evento',$responsavel);
	}


	public function consultarResponsavelPorId($id_responsavel){
		//condições para a consulta.
		$this->db->where('id_responsavel_evento', $id_responsavel);
		//realiza consulta e retorna apenas a primeira linha;
		$responsavel = $this->db->get("responsaveis_evento")->row_array();
		return $responsavel;
	}
	

	public function listarResponsaveis(){
		$responsaveis = $this->db->get("responsaveis_evento")->result_array();
		return $responsaveis;
	}

	

	public function excluirResponsavel($id_responsavel){
		$responsavel = $this->consultarResponsavelPorId($id_responsavel);
		unlink("./uploads/".$responsavel['assinatura_responsavel_evento']);
		$this->db->where('id_responsavel_evento',$id_responsavel);
		return $this->db->delete('responsaveis_evento');
	}

	public function consultarResponsavelPorNome($nome){
		//condições para a consulta.
		$this->db->like('nome_responsavel_evento', $nome);
		//realiza consulta e retorna apenas a primeira linha;
		$responsaveis = $this->db->get("responsaveis_evento")->result_array();
		return $responsaveis;
	}

}
