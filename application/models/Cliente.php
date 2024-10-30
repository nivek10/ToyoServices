<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id) 
	{
		$this->db->from('cliente');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function agregar($datos) 
	{
		$this->db->insert('cliente', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('cliente', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('cliente')) {
			return true;
		} else {
			return false;
		}
	}

	public function total_clientes() 
	{
		$query = $this->db->get('cliente');
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir) 
	{
		$this->db->from('cliente');
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
		$this->db->from('cliente');
		
		$this->db->like('id', $search);
		$this->db->or_like('nombres', $search);
		$this->db->or_like('apellidos', $search);
		$this->db->or_like('ci', $search);
		$this->db->or_like('telefono', $search);
		
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
		$this->db->from('cliente');
		
		$this->db->like('id', $search);
		$this->db->or_like('nombres', $search);
		$this->db->or_like('apellidos', $search);
		$this->db->or_like('ci', $search);
		$this->db->or_like('telefono', $search);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function verificar_ci_cliente($ci)
	{
		$this->db->from('cliente');
		$this->db->where('ci', $ci);
		$query = $this->db->get();

		return $query->num_rows();
	}

	public function get_clientes()
    {
        $this->db->from('cliente');
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return null;
        }
    }

}