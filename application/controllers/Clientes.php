<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('cliente');
	}

	public function index() 
	{
		redirect(base_url('clientes/listado'));
	}

	public function listado() 
	{
		$this->load->view('clientes/listado');
	}

	public function nuevo() 
	{
		$this->load->view('clientes/nuevo');
	}

	public function editar($id) 
	{
		$data['cliente'] = $this->cliente->get($id);
		$this->load->view('clientes/editar', $data);
	}

	public function get_clientes() 
	{
		$columns = array( 
			0 => 'id',
			1 => 'nombres',
			2 => 'apellidos',
			3 => 'ci',
			4 => 'telefono',
			5 => 'email'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->cliente->total_clientes();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$clientes = $this->cliente->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$clientes =  $this->cliente->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->cliente->total_buscados($search);
		}

		$data = array();

		if(!empty($clientes)) {
			foreach ($clientes as $cliente) {

				$nestedData['id']           = 	$cliente->id;
				$nestedData['nombres']      = 	$cliente->nombres;
				$nestedData['apellidos']  	=	$cliente->apellidos;
				$nestedData['ci']  			=	$cliente->ci;
				$nestedData['telefono']  	=	$cliente->telefono;
				$nestedData['email']  		=	$cliente->email;

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

	public function agregar() 
	{
		
		$this->form_validation->set_rules('nombres', 'Nombre del Cliente', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('apellidos', 'Apellidos del Cliente', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('ci', 'Nro de Cédula', 'trim|required|numeric');
		
		if($this->form_validation->run()) {

			$cliente = array(
				'nombres'        	=>	$this->input->post('nombres'),
				'apellidos'   		=>	$this->input->post('apellidos'),
				'ci'   				=>	$this->input->post('ci'),
				'telefono'   		=>	$this->input->post('telefono'),
				'direccion'   		=>	$this->input->post('direccion'),
				'nom_comercial'		=>	$this->input->post('nombre_comercial'),
				'nom_fiscal'   		=>	$this->input->post('nombre_fiscal'),
				'cod_postal'   		=>	$this->input->post('codigo_postal'),
				'poblacion'   		=>	$this->input->post('poblacion'),
				'provincia'   		=>	$this->input->post('provincia'),
				'pais'		   		=>	$this->input->post('pais'),
				'email'		   		=>	$this->input->post('email'),
				'web'		   		=>	$this->input->post('web')
			);

			$cliente = $this->cliente->agregar($cliente);

			if ($cliente > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $cliente)));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'invalido', 'msg' => 'Error al guardar el registro')));
			}

		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error', 'errors' => validation_errors())));
		}
	}

	public function actualizar()
	{
		
		$this->form_validation->set_rules('nombres', 'Nombre del Cliente', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('apellidos', 'Apellidos del Cliente', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('ci', 'Nro de Cédula', 'trim|required|numeric');

		if($this->form_validation->run()) {

			$id = $this->input->post('id');

			$cliente = array(
				'nombres'        	=>	$this->input->post('nombres'),
				'apellidos'   		=>	$this->input->post('apellidos'),
				'ci'   				=>	$this->input->post('ci'),
				'telefono'   		=>	$this->input->post('telefono'),
				'direccion'   		=>	$this->input->post('direccion'),
				'nom_comercial'		=>	$this->input->post('nombre_comercial'),
				'nom_fiscal'   		=>	$this->input->post('nombre_fiscal'),
				'cod_postal'   		=>	$this->input->post('codigo_postal'),
				'poblacion'   		=>	$this->input->post('poblacion'),
				'provincia'   		=>	$this->input->post('provincia'),
				'pais'		   		=>	$this->input->post('pais'),
				'email'		   		=>	$this->input->post('email'),
				'web'		   		=>	$this->input->post('web')
			);

			if ($this->cliente->actualizar($cliente, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'clientes/listado')));
			} else {
				$this->output->set_status_header(204);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'invalido', 'msg' => 'Error al guardar el registro')));
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

		if ($this->cliente->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}

	public function verifica_ci()
	{
		$ci = $this->input->post('ci');

		$res = $this->cliente->verificar_ci_cliente($ci);

		$this->output->set_status_header(200);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('res' => $res)));
	}
}