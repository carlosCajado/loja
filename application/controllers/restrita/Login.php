<?php

defined('BASEPATH') OR exit('ação permitida');

class Login extends CI_Controller{
    public function index(){
        $data = array(
            'titulo' => 'Login',
        );


        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/login/index');
        $this->load->view('restrita/layout/footer');

    }
    public function auth(){
        echo '<pre>';
        print_r($this->input->post());
        exit();
    }
}

