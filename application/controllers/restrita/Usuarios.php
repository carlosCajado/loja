
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
        if (!$usuario_id){
            //cadastrar

        }
        else{
            if(!$usuario = $this->ion_auth->user($usuario_id)->row()){
                $this->session->set_flashdata('erro','Usuario não Encontrado');
                redirect('restrita/usuarios');
                
            }else{
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