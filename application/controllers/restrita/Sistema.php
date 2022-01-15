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
        $this->form_validation->set_rules('sistema_razao_social','Razão social', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_nome_fantasia','Nome fantasia', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_cnpj','CNPJ', 'trim|required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie','SITEMA IE', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('sistema_telefone_fixo','Telefone Fixo', 'trim|required|exact_length[14]');
        $this->form_validation->set_rules('sistema_telefone_movel','Celular', 'trim|required|min_length[14]|max_length[15]');
        $this->form_validation->set_rules('sistema_cep','CEP', 'trim|required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco','Endereço', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_numero','Número', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('sistema_cidade','Cidade', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_estado', 'UF', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('sistema_site_url','url do Site', 'trim|required|valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_email','Email', 'trim|required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('sistema_produtos_destaques','Quantidade de Produtos', 'trim|required|integer');

        

        if ($this->form_validation->run()){
            $data = elements(
                array(
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_numero',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_produtos_destaques',
                ), $this->input->post()
            );
            $data['sistema_estado'] = strtoupper($data['sistema_estado']);
            $data = html_escape($data);
            
            $this->core_model->update('sistema', $data, array('sistema_id' => 1));
            redirect('restrita/sistema');

        }else{

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
}

