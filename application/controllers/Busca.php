<?php
defined('BASEPATH') OR exit('Ação não permitida');
class Busca extends CI_Controller {

	//habilida o word limited
	public function __construct(){
		parent::__construct();
		
	}

    public function index(){
        
        $busca = html_escape($this->input->Post('busca'));

        $data = array(

            'titulo' => 'Busca pelo produto:'.(!empty($busca) ? $busca :'Tente Novamente'),
            'pesquisa'=>(!empty($busca) ? $busca :'Tente Novamente'),

        );
        if($busca){
            if($Produtos = $this->produtos_model->get_by_busca($busca)){
                $data['produtos'] = $Produtos;
            }

        }
        $this->load->view('web/layout/header', $data);
        $this->load->view('web/busca');
        $this->load->view('web/layout/footer');

    }
}