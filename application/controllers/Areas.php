<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('area');
	}

	public function index() 
	{
		redirect(base_url('areas/listado'));
	}

	public function listado() 
	{
		$this->load->view('areas/listado');
	}

	public function nuevo() 
	{
		$this->load->view('areas/nuevo');
	}

	public function editar($id) 
	{
		$data['area'] = $this->area->get($id);
		$this->load->view('areas/editar', $data);
	}

	public function get_areas() 
	{
		$columns = array( 
			0 => 'id',
			1 => 'area',
			2 => 'descripcion'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->area->total_areas();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$areas = $this->area->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$areas =  $this->area->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->area->total_buscados($search);
		}

		$data = array();

		if(!empty($areas)) {
			foreach ($areas as $area) {

				$nestedData['id']           = $area->id;
				$nestedData['area']         = $area->area;
				$nestedData['descripcion']  =	$area->descripcion;

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
		
		$this->form_validation->set_rules('area', 'Área', 'trim|required|min_length[3]');
		
		if($this->form_validation->run()) {

			$area = array(
				'area'          => $this->input->post('area'),
				'descripcion'   => $this->input->post('descripcion')
			);

			$id_area = $this->area->agregar($area);

			if ($id_area > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_area)));
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
		
		$this->form_validation->set_rules('area', 'Área', 'trim|required|min_length[3]');

		if($this->form_validation->run()) {

			$id = $this->input->post('id');

			$area = array(
				'area'          => $this->input->post('area'),
				'descripcion'   => $this->input->post('descripcion')
			);

			if ($this->area->actualizar($area, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'areas/listado')));
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

		if ($this->area->borrar($id)) {
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