<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{	$sistema = info_header_footer();
		$data = array(
			'tutulo' => 'Seja Bem Vido(a) ao '.$sistema->sistema_nome_fantasia,	 
	);
		// echo '<pre>';
		// print_r($data);
		// die();
		$this->load->view('web/layout/header', $data);
		$this->load->view('web/loja');
		$this->load->view('web/layout/footer');
	}
}
