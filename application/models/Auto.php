<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auto extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id) 
	{
		$this->db->from('automobil');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function agregar($datos) 
	{
		$this->db->insert('automobil', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('automobil', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('automobil')) {
			return true;
		} else {
			return false;
		}
	}

	public function total_automoviles() 
	{
		$query = $this->db->get('automobil');
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir) 
	{
		$this->db->from('automobil');
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function buscar($limit, $start, $search, $order, $dir) {
		$this->db->from('automobil');
		
		$this->db->like('id', $search);
		$this->db->or_like('marca', $search);
		$this->db->or_like('descripcion', $search);
		
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function total_buscados($search) {
		$this->db->from('automobil');
		
		$this->db->like('id', $search);
		$this->db->or_like('marca', $search);
		$this->db->or_like('descripcion', $search);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function autos_cliente($cliente)
	{
		$this->db->from('automobil');
		$this->db->where('cliente', $cliente);
		$query = $this->db->get();
		return $query->result();
	}

}