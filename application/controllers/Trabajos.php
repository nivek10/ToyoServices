<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('automovil');
		$this->load->model('trabajo');
	}
	public function index()
	{
		redirect(base_url() . 'trabajos/listado');
	}

	public function listado()
	{
		$this->load->view('trabajos/listado');
	}

	public function get_trabajos()
	{
		$columns = array( 
            0 => 'id',
			1 => 'idauto',
			2 => 'detalle',
			3 => 'listo'
        );

		$limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
  
        $totalData = $this->trabajo->total_trabajos();
            
        $totalFiltered = $totalData; 
            
        if(empty($this->input->post('search')['value']))
        {            
            $trabajos = $this->trabajo->listar($limit,$start,$order,$dir);
        } else {
            $search = $this->input->post('search')['value']; 

            $trabajos =  $this->trabajo->buscar($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->trabajo->total_buscados($search);
        }

        $data = array();
        if(!empty($trabajos))
        {
            foreach ($trabajos as $trabajo)
            {
                $nestedData['id'] =	$trabajo->id;
				$nestedData['idauto'] = $trabajo->idauto;
				$nestedData['detalle'] = $trabajo->detalle;
				$nestedData['listo'] = $trabajo->listo;

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
		$data['encargados'] = $this->trabajo->listarEncargados();
		$data['automobiles'] = $this->trabajo->listarAutos();
		$this->load->view('trabajos/nuevo', $data);
	}

	public function agregar()
	{
		//var_dump($this->input->post());exit;
		$this->form_validation->set_rules('automovil', 'Automovil', 'trim|required|numeric');
		$this->form_validation->set_rules('encargados[]', 'Encargados', 'required');
		$this->form_validation->set_rules('detalle', 'Domicilio', 'trim|required|min_length[10]');

		if($this->form_validation->run()) {

			$trabajo = array(
				'idauto' => $this->input->post('automovil'),
				'detalle' => $this->input->post('detalle'),
				'listo' => 0
			);

			$id_trabajo = $this->trabajo->agregar($trabajo);

			for ($i = 0; $i < count($this->input->post('encargados')); $i++){ 
				$encargados = array(
					'trabajo' => $id_trabajo,
					'personal' => $this->input->post('encargados')[$i]
				);
				$this->trabajo->agregarPersonal($encargados);
			}	

			if ($id_trabajo > 0) {
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok', 'id' => $id_trabajo)));
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
		$data['trabajo'] = $this->trabajo->get($id);
		$data['autos'] = $this->trabajo->listarAutos();
		$this->load->view('trabajos/editar', $data);
	}

	public function finalizarTrabajo($idt)
	{
		$trabajo = array(
			'listo' => 1
		);

		if ($this->trabajo->finaliza($idt,$trabajo)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(204);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok', 'msg' => 'Error al finalizar el trabajo')));
		}
	}

	public function actualizar()
	{
		$this->form_validation->set_rules('automobil', 'Automovil', 'trim|required');
		$this->form_validation->set_rules('detalle', 'Detalle', 'trim|required|min_length[10]');

		if($this->form_validation->run()) {

			$id = $this->input->post('trabajo_id');
			
			$trabajo = array(
				'idauto' =>	$this->input->post('automobil'),
				'detalle' => $this->input->post('detalle'),
				'listo' => 0
			);

			if ($this->trabajo->actualizar($trabajo, $id)) {
				$this->session->set_flashdata('exito', 'Actualización Exitosa');
				$this->output->set_status_header(200);
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode(array('res' => 'ok_listar', 'listar' => base_url().'trabajos/listado')));
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

	public function borrar()
	{
		$id = $this->input->post('id');

		if ($this->trabajo->borrar($id)) {
			$this->output->set_status_header(200);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'ok')));
		} else {
			$this->output->set_status_header(401);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode(array('res' => 'error')));
		}
	}

	public function getEncargados($idt) {
        $data = $this->trabajo->getEncargadosTrabajo($idt);
        $this->output->set_status_header(200);
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($data));
    }
}
