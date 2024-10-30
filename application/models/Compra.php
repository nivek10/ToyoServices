<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get($id) 
	{
		$this->db->select('C.id, fecha, hora, proveedor');
		$this->db->from('compra_producto C');
		$this->db->join('compra_reg R', 'R.idcompra=C.id');
		$this->db->where('C.id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_compra($id) 
	{
		$this->db->select('P.id as id, R.id as cid, descripcion, marca, procedencia, R.cantidad, total_compra');
		$this->db->from('compra_producto C');
		$this->db->join('compra_reg R', 'R.idcompra=C.id');
		$this->db->join('producto P', 'P.id=R.producto');
		$this->db->where('C.id', $id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_proveedores() 
	{
		$this->db->select('*');
		$this->db->from('proveedor');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function actualizar_stock($tip,$id,$can,$car=0) 
	{
		$this->db->select('*');
		$this->db->from('producto');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$fila = $query->row();
		if($car==0){ $caa = $fila->unidades; }
		if($tip==1){
			if($car>0){ $caa = ($fila->unidades-$car); }
			$cantidad = ($caa+$can);
		}else{
			if($car>0){ $caa = ($fila->unidades+$car); }
			$cantidad = ($caa-$can);
		}
		$datos = array(
			'unidades' => $cantidad, 
		);
		$this->db->where('id', $id);
		if ($this->db->update('producto', $datos)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function reponer_stock($tip,$id,$reg=0) 
	{
		$this->db->select('P.id as id, R.cantidad, unidades');
		$this->db->from('compra_producto C');
		$this->db->join('compra_reg R', 'R.idcompra=C.id');
		$this->db->join('producto P', 'P.id=R.producto');
		if($reg==0){
			$this->db->where('R.id', $id);
			$query = $this->db->get();
			$fila = $query->row();
			if($tip==1){
				$cantidad = ($fila->unidades-$fila->cantidad);
			}else{
				$cantidad = ($fila->unidades+$fila->cantidad);
			}
			$datos = array(
				'unidades' => $cantidad, 
			);
			$this->db->where('id', $fila->id);
			if ($this->db->update('producto', $datos)) {
				return true;
			} else {
				return false;
			}
		}else{
			$this->db->where('C.id', $id);
			$query = $this->db->get();
			$fila = $query->result();
			foreach($fila as $f):
				if($tip==1){
					$cantidad = ($f->unidades-$f->cantidad);
				}else{
					$cantidad = ($f->unidades+$f->cantidad);
				}
				$datos = array(
					'unidades' => $cantidad, 
				);
				$this->db->where('id', $f->id);
				$this->db->update('producto', $datos);
				/*if ($this->db->update('producto', $datos)) {
					return true;
				} else {
					return false;
				}*/
			endforeach;
		}
	}

	public function agregar($datos) 
	{
		$this->db->insert('compra_producto', $datos);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function agregar_compra($datos) 
	{
		$this->db->insert('compra_reg', $datos);
		$id = $this->db->insert_id();
		return $id;
	}
	
	public function actualizar($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('compra_producto', $datos)) {
			return true;
		} else {
			return false;
		}
	}
	
	public function actualizar_compra($datos, $id) 
	{
		$this->db->where('id', $id);
		if ($this->db->update('compra_reg', $datos)) {
			return true;
		} else {
			return false;
		}
	}

	public function borrar($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('compra_producto')) {
			return true;
		} else {
			return false;
		}
	}
	
	public function borrar_compra($id) 
	{
		$this->db->where('id', $id);
		if ($this->db->delete('compra_reg')) {
			return true;
		} else {
			return false;
		}
	}

	public function total_compras() 
	{
		$this->db->from('compra_producto C');
		$this->db->join('proveedor P', 'C.proveedor=P.id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function listar($limit, $start, $order, $dir) 
	{
		$this->db->select('C.id, fecha, hora, nombre');
		$this->db->from('compra_producto C');
		$this->db->join('proveedor P', 'C.proveedor=P.id');
		$this->db->limit($limit, $start);
		if($order!=null){
			$this->db->order_by($order, $dir);
		}else{
			$this->db->order_by('fecha', 'desc');
			$this->db->order_by('hora', 'desc');
		}
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}

	public function buscar($limit, $start, $search, $order, $dir) {
		$this->db->select('C.id, fecha, hora, nombre');
		$this->db->from('compra_producto C');
		$this->db->join('proveedor P', 'C.proveedor=P.id');
		$this->db->like('C.id', $search);
		$this->db->or_like('fecha', $search);
		$this->db->or_like('hora', $search);
		$this->db->or_like('nombre', $search);
		
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
		$this->db->from('compra_producto');
		
		$this->db->like('id', $search);
		$this->db->or_like('fecha', $search);
		$this->db->or_like('hora', $search);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function productos()
	{
		//$this->db->select('descripcion,marca,procedencia');
		$this->db->select('id,descripcion,marca,procedencia,unidades');
		$this->db->from('producto');
		$this->db->order_by('descripcion', 'asc');
		$query = $this->db->get();
		if ($query->num_rows()) {
			return $query->result();
		} else {
			return null;
		}
	}
	
	public function buscar_producto($id)
	{
		$this->db->from("producto");
		$this->db->where("id",$id);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row();
		} else {
			return 0;
		}
	}

}