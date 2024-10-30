<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id) 
	{
		$this->db->from('producto');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function agregar($datos) 
	{
		$this->db->insert('producto', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('producto', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('producto')) {
			return true;
		} else {
			return false;
		}
	}

	public function total_productos() 
	{
		$query = $this->db->get('producto');
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir) 
	{
		$this->db->from('producto');
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
		$this->db->from('producto');
		
		$this->db->like('id', $search);
		$this->db->or_like('marca', $search);
		$this->db->or_like('descripcion', $search);
		$this->db->or_like('precio', $search);
		$this->db->or_like('unidades', $search);
		
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
		$this->db->from('producto');
		
		$this->db->like('id', $search);
		$this->db->or_like('marca', $search);
		$this->db->or_like('descripcion', $search);
		$this->db->or_like('precio', $search);
		$this->db->or_like('unidades', $search);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

}