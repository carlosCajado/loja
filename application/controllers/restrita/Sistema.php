<?php
defined('BASEPATH') OR exit ('Ação não Permitida');

class Sistema extends CI_Controller{
    public function __construct(){
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('restrita/login'); 
        }
        
    }
    public function index(){
        $data = array(
            'titulo' => 'Informações da Empresa',
            'scripts' => array(
                '/mask/jquery.mask.min.js',
                '/mask/custom.js'

            ), 
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id'=>1)),
        );
        // echo'<pre>';
        // print_r($data);
        // exit();
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/sistema/index');
        $this->load->view('restrita/layout/footer');
    }
}

