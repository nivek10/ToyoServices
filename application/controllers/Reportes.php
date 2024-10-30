<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('cliente');
		$this->load->model('proveedor');
		$this->load->model('usuario');
	}
	public function index()
	{
		redirect(base_url() . 'usuarios/ver');
	}

	public function ver()
	{
		$this->load->view('reportes/principal');
	}

	public function generar_pdf()
	{
		$tipo = $this->input->post('tipo_reporte');

		if ($tipo == 'clientes') {
			echo '<iframe src="' . base_url('reportes/reporte_clientes') . '" width="100%" height="800px"></iframe>';
		} else if($tipo == 'proveedores') {
			echo '<iframe src="' . base_url('reportes/reporte_proveedores') . '" width="100%" height="800px"></iframe>';
		} else if($tipo == 'personal') {
			echo '<iframe src="' . base_url('reportes/reporte_personal') . '" width="100%" height="800px"></iframe>';
		}
	}

	public function reporte_clientes()
	{
		$this->pdf = new Pdf('P', 'mm', 'Letter');
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();

		$this->pdf->SetFont('Arial', 'B', 8);
		$this->pdf->Ln(2);
		$this->pdf->Cell(0, 4, utf8_decode('LISTADO DE CLIENTES'), 0, 'R', 'C');
		$this->pdf->Ln();

		$clientes = $this->cliente->get_clientes();

		$this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->SetFillColor(201, 64, 103);
		$this->pdf->SetTextColor(255, 255, 255);

		$this->pdf->SetWidths(array(15, 65, 32, 32, 30, 0));
		$this->pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C'));
		$this->pdf->RowBigColor(array('Cod', 'Nombre Completo', 'Nro. de Cédula', 'Teléfono', 'Email', 'País'));

		$sw = true;
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->SetTextColor(0, 0, 0);
		foreach ($clientes as $cliente) {
			if ( $sw ) {
				$this->pdf->SetFillColor(255, 255, 255);
			} else {
				$this->pdf->SetFillColor(227, 227, 227);
			}

			$this->pdf->RowBigColor(array($cliente->id, $cliente->nombres . ' ' . $cliente->apellidos, $cliente->ci, $cliente->telefono, $cliente->email, $cliente->pais));
			$sw = !$sw;
		}


		echo $this->pdf->Output('reporte_clientes.pdf', 'I');
	}

	public function reporte_proveedores()
	{
		$this->pdf = new Pdf('P', 'mm', 'Letter');
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();

		$this->pdf->SetFont('Arial', 'B', 8);
		$this->pdf->Ln(2);
		$this->pdf->Cell(0, 4, utf8_decode('LISTADO DE PROVEEDORES'), 0, 'R', 'C');
		$this->pdf->Ln();

		$proveedores = $this->proveedor->get_proveedores();

		$this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->SetFillColor(48, 51, 107);
		$this->pdf->SetTextColor(255, 255, 255);

		$this->pdf->SetWidths(array(15, 65, 32, 32, 30, 0));
		$this->pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C'));
		$this->pdf->RowBigColor(array('Cod', 'Nombre Completo', 'Teléfono', 'Email', 'País', 'C. Postal'));

		$sw = true;
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->SetTextColor(0, 0, 0);
		foreach ($proveedores as $proveedor) {
			if ( $sw ) {
				$this->pdf->SetFillColor(255, 255, 255);
			} else {
				$this->pdf->SetFillColor(227, 227, 227);
			}

			$this->pdf->RowBigColor(array($proveedor->id, $proveedor->nombre, $proveedor->telefono, $proveedor->email, $proveedor->pais, $proveedor->cod_postal));
			$sw = !$sw;
		}


		echo $this->pdf->Output('reporte_clientes.pdf', 'I');
	}

	public function reporte_personal()
	{
		$this->pdf = new Pdf('P', 'mm', 'Letter');
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();

		$this->pdf->SetFont('Arial', 'B', 8);
		$this->pdf->Ln(2);
		$this->pdf->Cell(0, 4, utf8_decode('LISTADO DEL PERSONAL'), 0, 'R', 'C');
		$this->pdf->Ln();

		$personal = $this->usuario->get_personal();

		$this->pdf->Ln(5);
        $this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->SetFillColor(106, 176, 76);
		$this->pdf->SetTextColor(255, 255, 255);

		$this->pdf->SetWidths(array(15, 65, 32, 32, 30, 0));
		$this->pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C'));
		$this->pdf->RowBigColor(array('Cod', 'Nombre Completo', 'Teléfono', 'Email', 'País', 'C. Postal'));

		$sw = true;
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->SetTextColor(0, 0, 0);
		foreach ($personal as $persona) {
			if ( $sw ) {
				$this->pdf->SetFillColor(255, 255, 255);
			} else {
				$this->pdf->SetFillColor(227, 227, 227);
			}

			$this->pdf->RowBigColor(array($persona->id, $persona->nombres . ' ' . $persona->apellidos, $persona->telefono, $persona->email, $persona->pais, $persona->cod_postal));
			$sw = !$sw;
		}


		echo $this->pdf->Output('reporte_clientes.pdf', 'I');
	}

}
