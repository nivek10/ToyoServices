<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('compra');
	}

	public function index() 
	{
		redirect(base_url('compras/listado'));
	}

	public function listado() 
	{
		$this->load->view('compras/listado');
	}

	public function nuevo() 
	{
		$data['proveedores'] = $this->compra->get_proveedores();
		$this->load->view('compras/nuevo', $data);
	}

	public function editar($id) 
	{
		$data['compra'] = $this->compra->get($id);
		$data['compras'] = $this->compra->get_compra($id);
		$data['proveedores'] = $this->compra->get_proveedores();
		$this->load->view('compras/editar', $data);
	}

	public function get_compras() 
	{
		$columns = array( 
			0 => 'id',
			1 => 'fecha',
			2 => 'hora',
			3 => 'nombre'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->compra->total_compras();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$compras = $this->compra->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$compras =  $this->compra->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->compra->total_buscados($search);
		}

		$data = array();

		if(!empty($compras)) {
			foreach ($compras as $compra) {

				$nestedData['id']    = $compra->id;
				$nestedData['fecha'] = $compra->fecha;
				$nestedData['hora']  = $compra->hora;
				$nestedData['nombre']  = $compra->nombre;
				
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
		$this->form_validation->set_rules('proveedor', 'Proveedor', 'trim|required');
		
		date_default_timezone_set('America/La_Paz');
		if($this->form_validation->run()) {

			$compra = array(
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
				'proveedor' => $this->input->post('proveedor'),
                //'usuario' => $this->session->userdata('id'),
            );

            $id_compra = $this->compra->agregar($compra);
			
			for ($i=0; $i < count($this->input->post('id')); $i++) {
                $compra_reg = array(
                    'idcompra' => $id_compra, 
                    'producto' => $this->input->post('id')[$i], 
                    'total_compra' => $this->input->post('precio')[$i], 
                    'cantidad' => $this->input->post('cantidad')[$i] 
                );
                $this->compra->agregar_compra($compra_reg);
				$this->compra->actualizar_stock(1,$this->input->post('id')[$i],$this->input->post('cantidad')[$i]);
				//$this->compra->agregar_compra_reg($compra_reg, $this->input->post('pro_id')[$i], $this->input->post('cantidad')[$i], $this->input->post('tienda'));
            } 

			if ($id_compra > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_compra)));
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
		
		$this->form_validation->set_rules('proveedor', 'Proveedor', 'trim|required');

		date_default_timezone_set('America/La_Paz');
		if($this->form_validation->run()) {

			$id = $this->input->post('idc');

			$compra = array(
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
				'proveedor' => $this->input->post('proveedor'),
                //'usuario' => $this->session->userdata('id'),
            );
			
			for ($i=0; $i < count($this->input->post('id')); $i++) {
                if($this->input->post('idr')[$i]>0){
					$compra_reg = array(
						'total_compra' => $this->input->post('precio')[$i], 
						'cantidad' => $this->input->post('cantidad')[$i] 
					);
					$this->compra->actualizar_compra($compra_reg, $this->input->post('idr')[$i]);
					$this->compra->actualizar_stock(1,$this->input->post('id')[$i],$this->input->post('cantidad')[$i],$this->input->post('caa')[$i]);
				}else{
					$compra_reg = array(
						'idcompra' => $id, 
						'producto' => $this->input->post('id')[$i], 
						'total_compra' => $this->input->post('precio')[$i], 
						'cantidad' => $this->input->post('cantidad')[$i] 
					);
					$this->compra->agregar_compra($compra_reg);
					$this->compra->actualizar_stock(1,$this->input->post('id')[$i],$this->input->post('cantidad')[$i]);
				}
            } 

			if ($this->compra->actualizar($compra, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'compras/listado')));
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
		$this->compra->reponer_stock(1,$id,1);
		if ($this->compra->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}
	
	public function borrar_compra()
	{
		$id = $this->input->post('id');
		$this->compra->reponer_stock(1,$id);
		if ($this->compra->borrar_compra($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}
	
	public function productos()
	{
		$productos = $this->compra->productos();
		echo json_encode($productos);
	}
	
	public function buscar_producto()
	{
		$id = $this->input->post('id');
		$prod = $this->compra->buscar_producto($id);
		echo json_encode($prod);
	}
}