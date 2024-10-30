<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('producto');
	}

	public function index() 
	{
		redirect(base_url('productos/listado'));
	}

	public function listado() 
	{
		$this->load->view('productos/listado');
	}

	public function nuevo() 
	{
		$this->load->view('productos/nuevo');
	}

	public function editar($id) 
	{
		$data['producto'] = $this->producto->get($id);
		$this->load->view('productos/editar', $data);
	}

	public function get_productos() 
	{
		$columns = array( 
			0 => 'id',
			1 => 'marca',
			2 => 'nombre',
			3 => 'precio',
			4 => 'unidades'
		);

		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];
  
		$totalData = $this->producto->total_productos();
			
		$totalFiltered = $totalData; 
			
		if(empty($this->input->post('search')['value'])) { 

			$productos = $this->producto->listar($limit, $start, $order, $dir);

		} else {
			$search = $this->input->post('search')['value']; 

			$productos =  $this->producto->buscar($limit, $start, $search, $order, $dir);

			$totalFiltered = $this->producto->total_buscados($search);
		}

		$data = array();

		if(!empty($productos)) {
			foreach ($productos as $producto) {

				$nestedData['id']           = 	$producto->id;
				$nestedData['marca']       	= 	$producto->marca;
				$nestedData['descripcion']  =	$producto->nombre;
				$nestedData['precio']  		=	$producto->precio;
				$nestedData['unidades']  	=	$producto->unidades;

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
		
		$this->form_validation->set_rules('marca', 'Marca del Producto', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre del Producto', 'trim|required|min_length[3]');
		
		if($this->form_validation->run()) {

			$producto = array(
				'nombre'   				=>	$this->input->post('nombre'),
				'cod_ticket'			=>	$this->input->post('cod_ticket'),
				'marca'        			=>	$this->input->post('marca'),
				'tipo'   				=>	$this->input->post('tipo'),
				'familia'  				=>	$this->input->post('familia'),
				'procedencia'   		=>	$this->input->post('procedencia'),
				'precio'   				=>	$this->input->post('precio'),
				'unidades'   			=>	0,
				'foto_producto'   		=>	$this->input->post('imagen_producto'),
				'descripcion_breve'  	=>	$this->input->post('descripcion_breve'),
				'descripcion_extensa'  	=>	$this->input->post('descripcion_extensa'),
				'tipo_vehiculo'		  	=>	$this->input->post('tipo_vehiculo'),
				'marca_vehiculo'  		=>	$this->input->post('marca_vehiculo'),
				'kms'  					=>	$this->input->post('kms'),
				'motor_vehiculo'  		=>	$this->input->post('motor_vehiculo'),
				'color_vehiculo' 		=>	$this->input->post('color_vehiculo'),
				'proveedor'  			=>	$this->input->post('proveedor')
			);

			$id_producto = $this->producto->agregar($producto);

			if ($id_producto > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_producto)));
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
		
		$this->form_validation->set_rules('marca', 'Marca del Producto', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('nombre', 'Nombre del Producto', 'trim|required|min_length[3]');

		if($this->form_validation->run()) {

			$id = $this->input->post('id');

			$producto = array(
				'nombre'   				=>	$this->input->post('nombre'),
				'cod_ticket'			=>	$this->input->post('cod_ticket'),
				'marca'        			=>	$this->input->post('marca'),
				'tipo'   				=>	$this->input->post('tipo'),
				'familia'  				=>	$this->input->post('familia'),
				'procedencia'   		=>	$this->input->post('procedencia'),
				'precio'   				=>	$this->input->post('precio'),
				'foto_producto'   		=>	$this->input->post('imagen_producto'),
				'descripcion_breve'  	=>	$this->input->post('descripcion_breve'),
				'descripcion_extensa'  	=>	$this->input->post('descripcion_extensa'),
				'tipo_vehiculo'		  	=>	$this->input->post('tipo_vehiculo'),
				'marca_vehiculo'  		=>	$this->input->post('marca_vehiculo'),
				'kms'  					=>	$this->input->post('kms'),
				'motor_vehiculo'  		=>	$this->input->post('motor_vehiculo'),
				'color_vehiculo' 		=>	$this->input->post('color_vehiculo'),
				'proveedor'  			=>	$this->input->post('proveedor')
			);

			if ($this->producto->actualizar($producto, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'productos/listado')));
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

		if ($this->producto->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}

	public function upload_imagen()
	{
		$carpeta_fotos = "./assets/images/repuestos/";
		if (!empty($_FILES)) {
			// extenion del archivo
			$extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

			// nuevo nombre
			$foto = date('YmdHis') . '.' . $extension;

			if(rename($_FILES['imagen']['tmp_name'], $carpeta_fotos . $foto)){
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('foto' => $foto)));
			}else{
				$this->output->set_status_header(401);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('foto' => "error")));
			}
		}
	}
}