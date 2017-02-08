<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = "LoginController/home";
$route['valida-login'] = "LoginController/validaLogin";
$route['fazer-logoff'] = "LoginController/fazerLogoff";

$route['visualizar-perfil'] = "UsuariosController/visualizarPerfil";
$route['editar-perfil'] = "UsuariosController/editarPerfil";
$route['atualizar-perfil'] = "UsuariosController/atualizarPerfil";
$route['index'] = "UsuariosController/index";
$route['novo-usuario'] = "UsuariosController/novoUsuario";
$route['criar-usuario'] = "UsuariosController/criarUsuario";
$route['editar-usuario'] = "UsuariosController/editarUsuario";
$route['atualizar-usuario'] = "UsuariosController/atualizarUsuario";
$route['excluir-usuario'] = 'UsuariosController/excluirUsuario';
$route['alterar-senha'] = "UsuariosController/alterarSenha";
$route['atualizar-senha'] = "UsuariosController/atualizarSenha";
$route['listar-usuarios'] = "UsuariosController/listarUsuarios";
$route['emitir-certificado'] = 'UsuariosController/gerarCertificado';
$route['solicitar-alteracao'] = 'UsuariosController/solicitarAlteracaoDados';
$route['enviar-solicitacao'] = 'UsuariosController/enviarSolicitacao';
$route['pesquisar-usuario'] = 'UsuariosController/pesquisarUsuario';

$route['novo-evento'] = "EventosController/novoEvento";
$route['criar-evento'] = "EventosController/criarEvento";
$route['eventos-encerrados'] = "EventosController/listarEventosEncerrados";
$route['editar-evento'] = "EventosController/editarEvento";
$route['atualizar-evento'] = "EventosController/atualizarEvento";
$route['encerrar-evento'] = 'EventosController/encerrarEvento';
$route['detalhar-evento'] = "EventosController/detalharEvento";
$route['upar-planilha'] = 'EventosController/processarPlanilha';
$route['listar-participantes'] = 'EventosController/listarParticipantes';
$route['remover-participante'] = 'EventosController/removerParticipante';
$route['pesquisar-evento'] = 'EventosController/pesquisarEvento';
//$route['detalhar-evento/(:num)'] = "UsuariosController/detalharEvento/$1";

$route['listar-responsaveis'] = "ResponsaveisController/listarResponsaveis";
$route['novo-responsavel'] = "ResponsaveisController/novoResponsavel";
$route['criar-responsavel'] = "ResponsaveisController/criarResponsavel";
$route['editar-responsavel'] = "ResponsaveisController/editarResponsavel";
$route['atualizar-responsavel'] = "ResponsaveisController/atualizarResponsavel";
$route['excluir-responsavel'] = "ResponsaveisController/excluirResponsavel";
$route['pesquisar-responsavel'] = "ResponsaveisController/pesquisarResponsavel";

$route['JSON'] = "UsuariosController/geraJSON";
$route['login'] = "UsuariosController/login";


