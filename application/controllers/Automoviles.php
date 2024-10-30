<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Automoviles extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('auto');
		$this->load->model('cliente');
	}

	public function index() 
	{
		redirect(base_url('autos/listado'));
	}

	public function listado() 
	{
		$this->load->view('autos/listado');
	}

	public function nuevo($cliente) 
	{
		$data['cliente'] = $this->cliente->get($cliente);
		$this->load->view('autos/nuevo', $data);
	}

	public function editar($id) 
	{
		$data['auto'] = $this->auto->get($id);
		$this->load->view('autos/editar', $data);
	}

	public function agregar() 
	{
		
		$this->form_validation->set_rules('marca', 'Marca', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('modelo', 'Modelo', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('placa', 'Placa', 'trim|required|min_length[3]');
		
		if($this->form_validation->run()) {

			$auto = array(
				'cliente'       	=> $this->input->post('cliente_id'),
				'marca'          	=> $this->input->post('marca'),
				'modelo'   			=> $this->input->post('modelo'),
				'color'   			=> $this->input->post('color'),
				'anio'   			=> $this->input->post('anio'),
				'procedencia'   	=> $this->input->post('procedencia'),
				'placa'   			=> $this->input->post('placa'),
				'observaciones'   	=> $this->input->post('observaciones'),
				'tipo'   			=> $this->input->post('tipo'),
				'kms'   			=> $this->input->post('kms'),
				'bastidor' 			=> $this->input->post('bastidor'),
				'motor'   			=> $this->input->post('motor'),
				'fecha_compra'		=> $this->input->post('fecha_compra'),
				'localizacion'		=> $this->input->post('localizacion')
			);

			$id_auto = $this->auto->agregar($auto);

			if ($id_auto > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_auto)));
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

	public function autos_cliente()
	{
		$id_cliente = $this->input->post('cliente');
		$cliente = $this->cliente->get($id_cliente);
		$autos = $this->auto->autos_cliente($id_cliente);
		$this->output->set_status_header(200);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode(array('cliente' => $cliente, 'autos' => $autos)));
	}
}