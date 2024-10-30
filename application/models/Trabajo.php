<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trabajo extends CI_Model {
	public function __construct() {
        parent::__construct();
        $this->load->database(); 
    }

    public function get($id) {
    	$this->db->from('trabajo');
    	$this->db->where('id', $id);
    	$query = $this->db->get();
    	return $query->row();
    }

    public function total_trabajos() {
        $query = $this->db->get('trabajo');
        return $query->num_rows();
    }

    public function listarAutos() {
        $this->db->select('a.id, CONCAT(c.nombres, " ",c.apellidos) AS cliente, CONCAT(a.marca, " ", a.modelo) AS auto');
        $this->db->from('automobil a');
        $this->db->join('cliente c', 'c.id = a.cliente');
        $query = $this->db->get();
        return $query->result();
    }

    public function listarEncargados() {
        $this->db->select('p.id, CONCAT(p.nombres, " ",p.apellidos) AS encargado, a.area');
        $this->db->from('personal p');
        $this->db->join('area a', 'p.area = a.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function listarAreas() {
        $query = $this->db->get('area');
        return $query->result();
    }

    public function getEncargados($id) {
        $this->db->select('e.id, t.detalle, p.nombres');
        $this->db->from('encargado e');
        $this->db->join('trabajo t', 't.id = e.trabajo');
        $this->db->join('personal p', 'e.personal = p.id');
        $this->db->where('e.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getEncargadosTrabajo($id) {
        $this->db->select('p.id, CONCAT(p.nombres, " ",p.apellidos) AS persona');
        $this->db->from('encargado e');
        $this->db->join('trabajo t', 't.id = e.trabajo');
        $this->db->join('personal p', 'e.personal = p.id');
        $this->db->where('t.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function total_buscados($search)
    {
        $this->db->select('t.id, CONCAT(a.marca, " ", a.modelo) AS idauto, t.detalle, t.listo');
        $this->db->from('trabajo t');
        $this->db->join('automobil a', 't.idauto = a.id');
        $this->db->like('t.id', $search);
        $this->db->or_like('idauto', $search);
        $this->db->or_like('t.detalle', $search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function listar($limit, $start, $order, $dir) {
        $this->db->select('t.id, CONCAT(a.marca, " ", a.modelo) AS idauto, t.detalle, t.listo');
        $this->db->from('trabajo t');
        $this->db->join('automobil a', 't.idauto = a.id');
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
        $this->db->select('t.id, CONCAT(a.marca, a.modelo) AS idauto, t.detalle, t.listo');
        $this->db->from('trabajo t');
        $this->db->join('automobil a', 't.idauto = a.id');
        $this->db->like('t.id', $search);
        $this->db->or_like('idauto', $search);
        $this->db->or_like('t.detalle', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $dir);
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function agregar($datos) {
        $this->db->insert('trabajo', $datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function agregarPersonal($datos) {
        $this->db->insert('encargado', $datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function actualizar($datos,$id) {
        $this->db->where('id', $id);
        if ($this->db->update('trabajo', $datos)) {
            return true;
        } else {
            return false;
        }
    }   

    public function finaliza($idt,$trabajo) {
        $this->db->where('id', $idt);
        if ($this->db->update('trabajo', $trabajo)) {
            return true;
        } else {
            return false;
        }
    } 

    public function borrar($id) {
    	$this->db->where('id', $id);
        if ($this->db->delete('trabajo')) {
            return true;
        } else {
            return false;
        }
    }
}
