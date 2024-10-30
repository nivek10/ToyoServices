<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	} 

	public function total_usuarios()
	{
		$query = $this->db->get('usuario');
		return $query->num_rows();
	}

	public function get_usuario($id)
	{
		$this->db->from('personal');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_usuario_persona($id)
	{
		$this->db->from('usuario');
		$this->db->where('personal', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function verifica_ci_cliente($ci)
	{
		$this->db->from('personal');
		$this->db->where('ci', $ci);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir)
	{		
		$this->db->select('p.id, u.privilegios, a.area, CONCAT(p.nombres, " ", p.apellidos) AS name, p.direccion, p.telefono, p.ci, p.referencias');		
		$this->db->from('personal p');
		$this->db->join('area a', 'p.area = a.id');
		$this->db->join('usuario u', 'p.id = u.personal', 'left');
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function buscar($limit, $start, $search, $order, $dir)
	{
		$this->db->select('p.id, u.privilegios, a.area, CONCAT(p.nombres, " ", p.apellidos) AS name, p.direccion, p.telefono, p.ci, p.referencias');		
		$this->db->from('personal p');
		$this->db->join('area a', 'p.area = a.id');
		$this->db->join('usuario u', 'p.id = u.personal');
		$this->db->or_like('p.nombres', $search);
		$this->db->or_like('p.apellidos', $search);
		$this->db->or_like('p.direccion', $search);
		$this->db->or_like('p.referencias', $search);
		$this->db->limit($limit, $start);
		$this->db->order_by($order, $dir);
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function total_buscados($search)
	{
		$this->db->select('p.id, u.privilegios, a.area, CONCAT(p.nombres, " ", p.apellidos) AS name, p.direccion, p.telefono, p.ci, p.referencias');		
		$this->db->from('personal p');
		$this->db->join('area a', 'p.area = a.id');
		$this->db->join('usuario u', 'p.id = u.personal');
		$this->db->or_like('p.nombres', $search);
		$this->db->or_like('p.apellidos', $search);
		$this->db->or_like('p.direccion', $search);
		$this->db->or_like('p.referencias', $search);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function agregar($datos)
	{
		$this->db->insert('personal', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar($datos, $id)
	{
		$this->db->where('id', $id);
		if ($this->db->update('personal', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('personal')) {
			return true;
		} else {
			return false;
		}	
	}

	public function asignation($datos)
	{
		$this->db->insert('usuario', $datos);
		$id = $this->db->insert_id();
		return $id;
	}

	public function actualizar_cuenta($datos, $id)
	{
		$this->db->where('personal', $id);
		if ($this->db->update('usuario', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function login($username, $password)
    {
        $this->db->from('usuario');
        $this->db->where('usuario', $username);
        $this->db->where('contrasenia', $password);
        $res = $this->db->get();
        if ($res->num_rows() == 1) {
            $user = $res->row();

            $usr = array(
                'id' => $user->id,
                'usuario' => $user->usuario,
                'tipo' => $user->privilegios,
                'personal' => $user->personal,
                'login_taller' => true,
            );

            $this->session->set_userdata($usr);
            return true;
        } else {
            return false;
        }
    }

    public function listarAreas() {
    	$query = $this->db->get('area');
		return $query->result();
    }

    public function get_personal()
    {
    	$this->db->from('personal');
    	$query = $this->db->get();
    	return $query->result();
    }
}