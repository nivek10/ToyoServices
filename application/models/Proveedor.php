<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id) 
	{
		$this->db->from('proveedor');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_proveedores() 
	{
		$this->db->from('proveedor');
		$query = $this->db->get();
		return $query->result();
	}

	public function agregar($datos) 
	{
		$this->db->insert('proveedor', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('proveedor', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('proveedor')) {
			return true;
		} else {
			return false;
		}
	}

	public function total_proveedores() 
	{
		$query = $this->db->get('proveedor');
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir) 
	{
		$this->db->from('proveedor');
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
		$this->db->from('proveedor');
		
		$this->db->like('id', $search);
		$this->db->or_like('nombre', $search);
		$this->db->or_like('telefono', $search);
		$this->db->or_like('direccion', $search);
		
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
		$this->db->from('proveedor');
		
		$this->db->like('id', $search);
		$this->db->or_like('nombre', $search);
		$this->db->or_like('telefono', $search);
		$this->db->or_like('direccion', $search);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

}