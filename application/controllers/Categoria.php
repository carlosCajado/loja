<?php
defined('BASEPATH') OR exit('Ação não permitida');
class Categoria extends CI_Controller {

	//habilida o word limited
	public function __construct(){
		parent::__construct();
		
	}

    public function index($categoria_meta_link = null){
        if(!$categoria_meta_link || !$categoria = $this->core_model->get_by_id('categorias', array('categoria_meta_link' =>$categoria_meta_link))){
            redirect('/');

        }else{
            $data = array(

                'titulo' => 'Proutos Detalhes:'.$categoria->categoria_nome,
                'categoria'=>$categoria->categoria_nome,
                'produtos' => $this->produtos_model->get_all_by(array('categoria_meta_link' =>$categoria_meta_link)),

            );

            foreach ($data['produtos'] as $Produto){
                $data['categoria_pai_nome'] = $Produto->categoria_pai_nome;
                $data['categoria_pai_meta_link'] = $Produto->categoria_pai_meta_link;
            }

            	// echo '<pre>';
                // print_r($data);
                // die();
            $this->load->view('web/layout/header', $data);
            $this->load->view('web/categoria');
            $this->load->view('web/layout/footer');
        }


    }
}