<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('venta');
	}

	public function index() 
	{
		redirect(base_url('ventas/listado'));
	}

	public function listado() 
	{
		$this->load->view('ventas/listado');
	}

	public function nuevo() 
	{
		$data['clientes'] = $this->venta->get_clientes();
		$this->load->view('ventas/nuevo', $data);
	}

	public function editar($id) 
	{
		$data['venta'] = $this->venta->get($id);
		$data['ventas'] = $this->venta->get_venta($id);
		$data['clientes'] = $this->venta->get_clientes();
		$this->load->view('ventas/editar', $data);
	}

	public function get_ventas() 
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
  
		$totalData = $this->venta->total_ventas();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$ventas = $this->venta->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$ventas =  $this->venta->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->venta->total_buscados($search);
		}

		$data = array();

		if(!empty($ventas)) {
			foreach ($ventas as $venta) {

				$nestedData['id']    = $venta->id;
				$nestedData['fecha'] = $venta->fecha;
				$nestedData['hora']  = $venta->hora;
				$nestedData['nombre']  = $venta->nombre;
				
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
		$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required');
		
		date_default_timezone_set('America/La_Paz');
		if($this->form_validation->run()) {

			$venta = array(
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
				'cliente' => $this->input->post('cliente'),
                //'usuario' => $this->session->userdata('id'),
            );

            $id_venta = $this->venta->agregar($venta);
			
			for ($i=0; $i < count($this->input->post('id')); $i++) {
                $venta_reg = array(
                    'idventa' => $id_venta, 
                    'producto' => $this->input->post('id')[$i], 
                    'costo' => $this->input->post('precio')[$i], 
                    'cantidad' => $this->input->post('cantidad')[$i] 
                );
                $this->venta->agregar_venta($venta_reg);
				$this->venta->actualizar_stock(2,$this->input->post('id')[$i],$this->input->post('cantidad')[$i]);
				//$this->venta->agregar_venta_reg($venta_reg, $this->input->post('pro_id')[$i], $this->input->post('cantidad')[$i], $this->input->post('tienda'));
            } 

			if ($id_venta > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_venta)));
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
		
		$this->form_validation->set_rules('cliente', 'cliente', 'trim|required');

		date_default_timezone_set('America/La_Paz');
		if($this->form_validation->run()) {

			$id = $this->input->post('idc');

			$venta = array(
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s'),
				'cliente' => $this->input->post('cliente'),
                //'usuario' => $this->session->userdata('id'),
            );
			
			for ($i=0; $i < count($this->input->post('id')); $i++) {
                if($this->input->post('idr')[$i]>0){
					$venta_reg = array(
						'costo' => $this->input->post('precio')[$i], 
						'cantidad' => $this->input->post('cantidad')[$i] 
					);
					$this->venta->actualizar_venta($venta_reg, $this->input->post('idr')[$i]);
					$this->venta->actualizar_stock(2,$this->input->post('id')[$i],$this->input->post('cantidad')[$i],$this->input->post('caa')[$i]);
				}else{
					$venta_reg = array(
						'idventa' => $id, 
						'producto' => $this->input->post('id')[$i], 
						'costo' => $this->input->post('precio')[$i], 
						'cantidad' => $this->input->post('cantidad')[$i] 
					);
					$this->venta->agregar_venta($venta_reg);
					$this->venta->actualizar_stock(2,$this->input->post('id')[$i],$this->input->post('cantidad')[$i]);
				}
            } 

			if ($this->venta->actualizar($venta, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'ventas/listado')));
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
		$this->venta->reponer_stock(2,$id,1);
		if ($this->venta->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}
	
	public function borrar_venta()
	{
		$id = $this->input->post('id');
		$this->venta->reponer_stock(2,$id);
		if ($this->venta->borrar_venta($id)) {
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
		$productos = $this->venta->productos();
		echo json_encode($productos);
	}
	
	public function buscar_producto()
	{
		$id = $this->input->post('id');
		$prod = $this->venta->buscar_producto($id);
		echo json_encode($prod);
	}
}