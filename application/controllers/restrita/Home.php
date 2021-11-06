<?php

defined ('BASEPATH') or exit ('Ação não permitida');

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();

        //Existe uma sessã:o
    }
    public function index(){

        $this->load->view('restrita/home/index');
    }
}