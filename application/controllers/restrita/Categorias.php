<?php 

defined('BASEPATH') OR exit ('Ação nao permitida');

class Categorias extends CI_Controller{

    public function __construct(){
        parent::__construct();

        if(!$this->ion_auth->logged_in()){
            redirect('restrita/login');
        }

    }
    public function index(){
    
        $data = array(

            'titulo' => 'Categorias cadastrados',

            'styles' => array(
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',

            ),

            'scripts' => array(
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js'
            ),

            'categorias'=> $this->core_model->get_all('categorias'), 
            
        );

        // echo'<pre>';
        // print_r($data);
        // die();

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/categorias/index');
        $this->load->view('restrita/layout/footer');

    }

    public function core($categoria_id = NULL){

        if(!$categoria_id){
            //cadastrando categoria pai
    
            $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[5]|max_length[40]|callback_valida_nome_categorias');
    
            if($this->form_validation->run()){
    
                $data = elements(
                    array(
                        'categoria_nome',
                        'categoria_ativa',
                        'categoria_pai_id',
                    ), $this->input->post()
                );
    
                //criando meta link
                $data['categoria_meta_link'] = url_amigavel($data['categoria_nome']);
    
                $data = html_escape($data);
    
                $this->core_model->insert('categorias', $data);
                redirect('restrita/categorias');
    
            }else{
    
                $data = array(
    
                    'titulo' => 'Cadastrar categorias',
                    'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa'=>1)),
                );
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/categorias/core');
                $this->load->view('restrita/layout/footer');
    
            }
    
    
        }else{

            if(!$categoria = $this->core_model->get_by_id('categorias', array('categoria_id'=> $categoria_id))){
                $this->session->set_flashdata('erro', 'A categoria não foi encontrada');
                redirect('restrita/categorias');

            }else{
                //editando

                $this->form_validation->set_rules('categoria_nome', 'Nome da categoria', 'trim|required|min_length[4]|max_length[40]|callback_valida_nome_categorias');

                if($this->form_validation->run()){

                    $data = elements(
                        array(
                            'categoria_nome',
                            'categoria_ativa',
                            'categoria_pai_id',
                        ), $this->input->post()
                    );

                    //criando meta link
                    $data['categoria_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                    $data = html_escape($data);

                    $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));
                    redirect('restrita/categorias');

                }else{

                    $data = array(

                        'titulo' => 'Editar categoria',
                        'categoria'=> $categoria, 
                        'masters' => $this->core_model->get_all('categorias_pai', array('categoria_pai_ativa'=>1)),
                    );
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/categorias/core');
                    $this->load->view('restrita/layout/footer');

                }


            }

        }
        
            
    
    }
    public function valida_nome_categorias($categoria_nome){
    
        $categoria_id = (int) $this->input->post('categoria_id');
        
        if (!$categoria_id){
            //cadastrando

            if ($this->core_model->get_by_id('categorias', array('categoria_nome'=> $categoria_nome))){
                $this->form_validation->set_message('valida_nome_categorias','Essa categoria ja existe');
                return false;
            }else{
                return true;
            }

        }else{
            //Editando

            if ($this->core_model->get_by_id('categorias', array('categoria_nome'=> $categoria_nome, 'categoria_id !=' => $categoria_id))){
                $this->form_validation->set_message('valida_nome_categorias','Esse categoria ja existe');
                return false;
            }else{
                return true;
            }
    }
    }
    public function delete($categoria_id = NULL){

        $categoria_id=(int)$categoria_id;
        
        if(!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))){
            $this->session->set_flashdata('erro', 'A categoria pai não foi encontrada');
                redirect('restrita/categorias');
        }

        if($this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id, 'categoria_ativa' => 1))){
            $this->session->set_flashdata('erro', 'Não é possivel excluir uma categoria ativa');
                redirect('restrita/categorias');
        }

        $this->core_model->delete('categorias', array('categoria_id' => $categoria_id));
        redirect('restrita/categorias');

    }

}