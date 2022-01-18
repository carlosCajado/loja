<?php
defined('BASEPATH') or exit ('Ação Não permitida');
class Usuarios extends CI_Controller{
    public function __construct(){
        parent::__construct();
        //Sessão Válida? 

    }
public function index(){
    $data = array(
        'titulo' => 'Clientes cadastrados',
        'styles' => array (
            'bundles/datatables/datatables.min.css',
            'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'
        ),
        'scripts' => array(
            'bundles/datatables/datatables.min.js',
            'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
            'bundles/jquery-ui/jquery-ui.min.js',
            'js/page/datatables.js'

        ),
        'usuarios'=>  $users = $this->ion_auth->users()->result(), // get all users
    );
 //   echo'<pre>';
  //  print_r ($data['usuarios']);
   // exit();
    $this->load->view('restrita/layout/header', $data);
    $this->load->view('restrita/usuarios/index');
    $this->load->view('restrita/layout/footer');


    }
    public function core($usuario_id = NULL){
        $usuario_id = (int) $usuario_id;
        if (!$usuario_id){
            //cadastrar
            $this->form_validation->set_rules('first_name','Nome', 'trim|required|min_length[4] |max_length[45]');
            $this->form_validation->set_rules('last_name','Sobrenome', 'trim|required|min_length[4] |max_length[45]');
            $this->form_validation->set_rules('email','E-mail', 'trim|required|min_length[4] |max_length[45]|valid_email|callback_valida_email');
            $this->form_validation->set_rules('username','Usuário', 'trim|required|min_length[4] |max_length[45]');
            $this->form_validation->set_rules('password','Senha', 'trim|required|min_length[4] |max_length[45]');
            $this->form_validation->set_rules('confirma','confirma', 'trim|required|matches[password]');
            if($this->form_validation->run()){
                    // echo '<pre>';
                    // print_r($this->input->post());
                    // exit();
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $email = $this->input->post('email');
                    $additional_data = array(
                        'first_name'=>  $this->input->post('first_name'),
                        'last_name'=> $this->input->post('last_name'),
                        'active'=> $this->input->post('active'),

                    );
                    $group = array($this->input->post('perfil'));
                    // echo '<pre>';
                    // print_r($username);
                    // exit();
                    if($this->ion_auth->register($username,  $password, $email, $additional_data, $group )){
                        $this->session->set_flashdata('Sucesso', 'Dados Salvos com sucesso');
                        
                    }else{
                        $this->session->set_flashdata('erro', $this->ion_auth->errors());

                    }

                    redirect('restrita/usuarios');
            }else{
                    //erro de validação 
                    $data = array(
                        'titulo' =>'Cadastrar usuário',
                        'grupos' => $this->ion_auth->groups()->result(),
                        
                    );
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
            }

        }
        else{
            if(!$usuario = $this->ion_auth->user($usuario_id)->row()){
                $this->session->set_flashdata('erro','Usuario não Encontrado');
                redirect('restrita/usuarios');
                
            }else{

                $this->form_validation->set_rules('first_name','Nome', 'trim|required|min_length[4] |max_length[45]');
                $this->form_validation->set_rules('last_name','Sobrenome', 'trim|required|min_length[4] |max_length[45]');
                $this->form_validation->set_rules('email','E-mail', 'trim|required|min_length[4] |max_length[45]|valid_email|callback_valida_email');
                $this->form_validation->set_rules('username','Usuário', 'trim|required|min_length[4] |max_length[45]');
                $this->form_validation->set_rules('password','Senha', 'trim|min_length[4] |max_length[45]');
                $this->form_validation->set_rules('confirma','confirma', 'trim|matches[password]');

                if($this->form_validation->run()){
                    // echo '<pre>';
                    // print_r($this->input->post());
                    // exit();
                    $data = elements(
                        array(
                            'first_name',
                            'last_name',
                            'email',
                            'username',
                            'password',
                            'active',
                        ), $this->input->post()
                    );

                    $password = $this->input->post('password');
                    //não atualiza a senha se a mesma não for passada
                    if(!$password) {
                        unset($data['password']);
                    }
                    //sanitizando o data
                    $data = html_escape($data);
                                       
                    // echo '<pre>';
                    // print_r($data);
                    // exit();

                   if( $this->ion_auth->update($usuario_id, $data)){
                       $perfil = (int) $this->input->post('perfil');
                       if($perfil){

                         $this->ion_auth->remove_from_group(NULL, $usuario_id);
                         $this->ion_auth->add_to_group($perfil, $usuario_id);
                       }

                        $this->session->set_flashdata('Sucesso', 'Dados Salvos com sucesso');
                   }else{
                        $this->session->set_flashdata('erro', $this->ion_auth->errors());
                   }
                    redirect('restrita/usuarios');


                }else{
                    //erro de validação 
                    $data = array(
                        'titulo' =>'Editar usuario',
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth-> get_users_groups ($usuario_id)->row(),
                        'grupos' => $this->ion_auth->groups()->result(),
                        
                    );
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
                     
                }
            
            }
        }

    }
//função responsavel por validar o email
    public function valida_email($email){
        $usuario_id = $this->input->post('usuario_id');
        if(! $usuario_id){
            if($this->core_model->get_by_id('users', array('email'=>$email))){
                $this->form_validation->set_message('valida_email', 'Esse enail já existe');
                return false;
            }else{
                return true;
            }
            //cadastrar
        }else{
            //edidt
            if($this->core_model->get_by_id('users', array('email'=>$email, 'id !='=> $usuario_id))){
                $this->form_validation->set_message('valida_email', 'Esse enail já existe');
                return false;
            }else{
                return true;
            }
        }
    }
    //função responsavel por deletar usuario

    public function delete($usuario_id= NULL){
        $usuario_id = (int) $usuario_id;
        if(!$usuario_id || !$this->ion_auth->user($usuario_id)->row()){
                $this->session->set_flashdata('erro', 'usuario não encontrado');
                redirect('restrita/usuarios');

            //sem id
        }else{
            //delete
            if($this->ion_auth->is_admin($usuario_id)){
                $this->session->set_flashdata('erro', 'usuário administrador');
                redirect('restrita/usuarios');
            }
            if($this->ion_auth->delete_user($usuario_id)){
                $this->session->set_flashdata('Sucesso', 'usuário apagado');  
            }else{
                
                $this->session->set_flashdata('erro', $this->ion_auth->errors());

            }
            redirect('restrita/usuarios'); 
        }
    }

}