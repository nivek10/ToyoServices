<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('proveedor');
	}

	public function index() 
	{
		redirect(base_url('proveedores/listado'));
	}

	public function listado() 
	{
		$this->load->view('proveedores/listado');
	}

	public function nuevo() 
	{
		$this->load->view('proveedores/nuevo');
	}

	public function editar($id) 
	{
		$data['proveedor'] = $this->proveedor->get($id);
		$this->load->view('proveedores/editar', $data);
	}

	public function get_proveedores() 
	{
		$columns = array( 
			0 => 'id',
			1 => 'nombre',
			2 => 'telefono',
			3 => 'direccion'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->proveedor->total_proveedores();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$proveedores = $this->proveedor->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$proveedores =  $this->proveedor->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->proveedor->total_buscados($search);
		}

		$data = array();

		if(!empty($proveedores)) {
			foreach ($proveedores as $proveedor) {

				$nestedData['id']           = 	$proveedor->id;
				$nestedData['nombre']       = 	$proveedor->nombre;
				$nestedData['telefono']  	=	$proveedor->telefono;
				$nestedData['direccion']  	=	$proveedor->direccion;

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
		
		$this->form_validation->set_rules('nombre', 'Nombre del Proveedor', 'trim|required|min_length[3]');
		
		if($this->form_validation->run()) {

			$proveedor = array(
				'nombre'        	=>	$this->input->post('nombre'),
				'direccion'   		=>	$this->input->post('direccion'),
				'telefono'   		=>	$this->input->post('telefono'),
				'descripcion'   	=>	$this->input->post('descripcion'),
				'nom_comercial'   	=>	$this->input->post('nom_comercial'),
				'nom_fiscal'   		=>	$this->input->post('nom_fiscal'),
				'cod_postal'   		=>	$this->input->post('cod_postal'),
				'poblacion'   		=>	$this->input->post('poblacion'),
				'provincia'   		=>	$this->input->post('provincia'),
				'pais'   			=>	$this->input->post('pais'),
				'email'   			=>	$this->input->post('email'),
				'web'   			=>	$this->input->post('web')
			);

			$id_proveedor = $this->proveedor->agregar($proveedor);

			if ($id_proveedor > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_proveedor)));
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
		
		$this->form_validation->set_rules('nombre', 'Nombre del Proveedor', 'trim|required|min_length[3]');

		if($this->form_validation->run()) {

			$id = $this->input->post('id');

			$proveedor = array(
				'nombre'        	=>	$this->input->post('nombre'),
				'direccion'   		=>	$this->input->post('direccion'),
				'telefono'   		=>	$this->input->post('telefono'),
				'descripcion'   	=>	$this->input->post('descripcion'),
				'nom_comercial'   	=>	$this->input->post('nom_comercial'),
				'nom_fiscal'   		=>	$this->input->post('nom_fiscal'),
				'cod_postal'   		=>	$this->input->post('cod_postal'),
				'poblacion'   		=>	$this->input->post('poblacion'),
				'provincia'   		=>	$this->input->post('provincia'),
				'pais'   			=>	$this->input->post('pais'),
				'email'   			=>	$this->input->post('email'),
				'web'   			=>	$this->input->post('web')
			);

			if ($this->proveedor->actualizar($proveedor, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'proveedores/listado')));
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

		if ($this->proveedor->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}
}