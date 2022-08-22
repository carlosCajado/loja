<?php
defined('BASEPATH') OR exit('Ação não permitida');
class Produto extends CI_Controller {

	//habilida o word limited
	public function __construct(){
		parent::__construct();
		
	}

    public function index($produto_meta_link = null){
        if(!$produto_meta_link || !$produto = $this->produtos_model->get_by_id($produto_meta_link)){
            redirect('/');

        }else{
            $data = array(

                'titulo' => 'Cadastrar produto',
                'produto' => $produto,
                'scripts' => array(
                    'mask/jquery.mask.min.js',
                    'mask/custom.js',
                    'js/add_produto.js'
                ),
            );
            $data['fotos_produtos'] = $this->core_model->get_all('produtos_fotos', array('foto_produto_id'=>$produto->produto_id));

            	// echo '<pre>';
                // print_r($data);
                // die();
            $this->load->view('web/layout/header', $data);
            $this->load->view('web/produto');
            $this->load->view('web/layout/footer');
        }


    }
}