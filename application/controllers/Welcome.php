<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	//habilida o word limited
	public function __construct(){
		parent::__construct();
		$this->load->helper('text');
		
	}


	public function index()
	{	$sistema = info_header_footer();
		$data = array(
			'tutulo' => 'Seja Bem Vido(a) ao '.$sistema->sistema_nome_fantasia,	
			'produtos_destaques'=> $this->loja_model->get_produtos_destaques($sistema->sistema_produtos_destaques), 
	);
		// echo '<pre>';
		// print_r($data['produtos_destaques']);
		// die();
		$this->load->view('web/layout/header', $data);
		$this->load->view('web/loja');
		$this->load->view('web/layout/footer');
	}
}
