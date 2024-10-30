<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
	}
	public function index()
	{
		redirect(base_url() . 'usuarios/listado');
	}

	public function listado()
	{
		$this->load->view('usuarios/listado');
	}

	public function get_usuarios()
	{
		$columns = array( 
			0 => 'id',
			1 => 'area',
			2 => 'name',
			3 => 'direccion',
			5 => 'telefono',
			6 => 'ci',
			7 => 'referencias'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->usuario->total_usuarios();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value']))
		{            
			$usuarios = $this->usuario->listar($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$usuarios =  $this->usuario->buscar($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->usuario->total_buscados($search);
		}

		$data = array();
		if(!empty($usuarios))
		{
			foreach ($usuarios as $usuario)
			{
				$nestedData['id'] =	$usuario->id;
				$nestedData['area'] = $usuario->area;
				$nestedData['name'] = $usuario->name;
				$nestedData['direccion'] = $usuario->direccion;
				$nestedData['telefono'] = $usuario->telefono;
				$nestedData['ci'] =	$usuario->ci;
				$nestedData['referencias'] = $usuario->referencias;
				$nestedData['privilegios'] = $usuario->privilegios;

				$data[] = $nestedData;
			}
		}
		  
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
			
		echo json_encode($json_data); 
	}

	public function nuevo()
	{
		$data['areas'] = $this->usuario->listarAreas();
		$this->load->view('usuarios/nuevo', $data);
	}

	public function agregar()
	{
		$this->form_validation->set_rules('area', 'Área', 'trim|required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]');

		if($this->form_validation->run()) {

			$usuario = array(
				'area' 			=> $this->input->post('area'),
				'nombres' 		=> $this->input->post('nombres'),
				'apellidos' 	=> $this->input->post('apellidos'),
				'direccion' 	=> $this->input->post('direccion'),
				'telefono' 		=> $this->input->post('telefono'),
				'ci' 			=> $this->input->post('ci'),
				'referencias' 	=> $this->input->post('referencias'),
				'cod_postal' 	=> $this->input->post('cod_postal'),
				'poblacion' 	=> $this->input->post('poblacion'),
				'provincia' 	=> $this->input->post('provincia'),
				'pais' 			=> $this->input->post('pais'),
				'email' 		=> $this->input->post('email'),
				'web' 			=> $this->input->post('web'),
			);

			$id_usuario = $this->usuario->agregar($usuario);

			if ($id_usuario > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_usuario)));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'msg' => 'Error al guardar la el registro')));
			}

		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error', 'errors' => validation_errors())));
		}
	}

	public function editar($id)
	{
		$data['areas'] = $this->usuario->listarAreas();
		$data['usuario'] = $this->usuario->get_usuario($id);
		$this->load->view('usuarios/editar', $data);
	}

	public function asigna($id)
	{
		$data['personal'] = $this->usuario->get_usuario($id);
		$data['usuario'] = $this->usuario->get_usuario_persona($id);
		$this->load->view('usuarios/asigna', $data);
	}

	public function actualizar()
	{
		$this->form_validation->set_rules('area', 'Área', 'trim|required');
		$this->form_validation->set_rules('nombres', 'Nombres', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]');

		if($this->form_validation->run()) {

			$id = $this->input->post('id');

			$usuario = array(
				'area' 			=> $this->input->post('area'),
				'nombres' 		=> $this->input->post('nombres'),
				'apellidos' 	=> $this->input->post('apellidos'),
				'direccion' 	=> $this->input->post('direccion'),
				'telefono' 		=> $this->input->post('telefono'),
				'ci' 			=> $this->input->post('ci'),
				'referencias' 	=> $this->input->post('referencias'),
				'cod_postal' 	=> $this->input->post('cod_postal'),
				'poblacion' 	=> $this->input->post('poblacion'),
				'provincia' 	=> $this->input->post('provincia'),
				'pais' 			=> $this->input->post('pais'),
				'email' 		=> $this->input->post('email'),
				'web' 			=> $this->input->post('web'),
			);

			if ($this->usuario->actualizar($usuario, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'usuarios/listado')));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'msg' => 'Error al guardar la el registro')));
			}

		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error', 'errors' => validation_errors())));
		}
	}

	public function actualizar_usr()
	{
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('privilegios', 'Privilegios', 'trim|required');
		$id_persona = $this->input->post('idpersonal');
		// var_dump($this->input->post()); exit;

		if($this->form_validation->run()) {

			$id = $this->input->post('idpersonal');
			
			$usuario = array(
				'usuario' => $this->input->post('usuario'),
				'contrasenia' => hash("sha256", $this->input->post('contrasenia')),
				'privilegios' => $this->input->post('privilegios'),
				'personal' => $id
			);

			if ($this->usuario->actualizar_cuenta($usuario, $id_persona)) {
				$this->session->set_flashdata('exito', 'Asignación Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'usuarios/listado')));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'msg' => 'Error al asignar el registro')));
			}

		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error', 'errors' => validation_errors())));
		}
	}

	public function asignar()
	{
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('privilegios', 'Privilegios', 'trim|required');

		if($this->form_validation->run()) {

			$id = $this->input->post('idpersonal');
			
			$usuario = array(
				'usuario' => $this->input->post('usuario'),
				'contrasenia' => hash("sha256", $this->input->post('contrasenia')),
				'privilegios' => $this->input->post('privilegios'),
				'personal' => $id
			);

			if ($this->usuario->asignation($usuario)) {
				$this->session->set_flashdata('exito', 'Asignación Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'usuarios/listado')));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'msg' => 'Error al asignar el registro')));
			}

		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error', 'errors' => validation_errors())));
		}
	}

	public function borrar()
	{
		$id = $this->input->post('id');

		if ($this->usuario->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}
	
	public function ingresar()
	{
		$username = $this->input->post('usuario');
		$password = hash("sha256", $this->input->post('contrasenia'));
		// var_dump($this->input->post(), $password);
		if ($this->usuario->login($username, $password)){
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('resp' => 'login', 'url' => base_url('inicio'))));
		} else {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('resp' => 'error')));
		}
	}

	public function login()
	{
		$this->load->view('usuarios/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'usuarios/login');
	}

	public function verifica_ci(){
		$ci = $this->input->post('ci');

		$res = $this->usuario->verifica_ci_cliente($ci);

		$this->output->set_status_header(200);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('res' => $res)));
	}
}
