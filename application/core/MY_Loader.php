<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_loader {

	public function template($nome, $dadosUsuario = array(), $dados = array()){
		$this->view("template/cabecalho.php",$dadosUsuario);
		$this->view($nome, $dados);
	}
}