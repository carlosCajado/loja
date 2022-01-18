<?php

defined('BASEPATH') or exit('Ação nao permitida');

class Produtos extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        
        // if(!$this->ion_auth->logged_in()){    BUGA TUDO LASLAKSL
        //     redirect('restrita/login');
        // }
    
    }
    public function index()
    {

        $data = array(

            'titulo' => 'produtos cadastrados',

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

            'produtos' => $this->produtos_model->get_all(),
        );

        // echo '<pre>';
        // print_r($data['produtos']);
        // die;

        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/produtos/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($produto_id = NULL)
    {

        $produto_id = (int) $produto_id;

        if (!$produto_id) {
            //cadastrando...
            $this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[2]|max_length[80]|callback_valida_nome_produto');
            $this->form_validation->set_rules('produto_categoria_id', 'Categoria do produto', 'trim|required');
            $this->form_validation->set_rules('produto_marca_id', 'Marca do produto', 'trim|required');
            $this->form_validation->set_rules('produto_valor', 'Valor do produto', 'trim|required');
            $this->form_validation->set_rules('produto_descricao', 'Descrição do produto', 'trim|required|min_length[2]|max_length[5000]');
            $this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
            $this->form_validation->set_rules('produto_largura', 'Altura do produto', 'trim|required|integer');
            $this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
            $this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
            $this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade em estoque', 'trim|required|integer');

            $fotos_produtos = $this->input->post('fotos_produtos');

            if (!$fotos_produtos){
                $this->form_validation->set_rules('fotos_produtos','Imagens do produto', 'required');
            }


            if($this->form_validation->run()) {

                // echo '<pre>';
                // print_r($this->input->post());
                // exit;
                
                $data = elements(
                    array(
                        'produto_nome',
                        'produto_valor',
                        'produto_categoria_id',
                        'produto_marca_id',
                        'produto_descricao',
                        'produto_largura',
                        'produto_ativo',
                        'produto_peso',
                        'produto_altura',
                        'produto_comprimento',
                        'produto_quantidade_estoque'
                    ), $this->input->post()
                );
                //removendo virgula
                $data['produto_valor'] = str_replace(',','',$data['produto_valor']);

                //criando metalink
                $data['produto_meta_link'] = url_amigavel($data['produto_nome']);

                $data = html_escape($data);
                $data['produto_codigo'] = $this->input->post('produto_codigo');

                     
           
                $this->core_model->insert('produtos', $data, TRUE);

                $produto_id = $this-> session-> userdata('last_id');


                $fotos_produtos = $this->input->post('fotos_produtos'); 
                if($fotos_produtos){

                       $total_fotos = count($fotos_produtos);
                for($i=0; $i <$total_fotos; $i++){
                    $data = array(
                        'foto_produto_id' => $produto_id,
                        'foto_caminho' => $fotos_produtos[$i],
                    );
                    $this->core_model->insert('produtos_fotos',$data);
                }

                }

             

                redirect('restrita/produtos');

            } else {


                $data = array(

                    'titulo' => 'Cadastrar produto',
                    'styles' => array(
                        'jquery-upload-file/css/uploadfile.css',
                    ),

                    'scripts' => array(
                        'sweetalert2/sweetalert2.all.min.js',
                        'jquery-upload-file/js/jquery.uploadfile.min.js',
                        'jquery-upload-file/js/produtos.js',
                        'mask/jquery.mask.min.js',
                        'mask/custom.js'
                    ),

                    'codigo_gerado'=>$this->core_model->generate_unique_code('produtos','numeric',8,'produto_codigo'),
                    'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                    'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                );


                        // echo '<pre>';
                        // print_r($data['produto']);
                        // die;

                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/produtos/core');
                $this->load->view('restrita/layout/footer');
            }


        } else {

                // editando
            if (!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {

                $this->session->set_flashdata('erro', 'Esse produto não foi encontrado');
                redirect('restrita/produtos');

            } else {
                $this->form_validation->set_rules('produto_nome', 'Nome do produto', 'trim|required|min_length[2]|max_length[80]|callback_valida_nome_produto');
                $this->form_validation->set_rules('produto_categoria_id', 'Categoria do produto', 'trim|required');
                $this->form_validation->set_rules('produto_marca_id', 'Marca do produto', 'trim|required');
                $this->form_validation->set_rules('produto_valor', 'Valor do produto', 'trim|required');
                $this->form_validation->set_rules('produto_largura', 'Altura do produto', 'trim|required|integer');
                $this->form_validation->set_rules('produto_descricao', 'Descrição do produto', 'trim|required');
                $this->form_validation->set_rules('produto_peso', 'Peso do produto', 'trim|required|integer');
                $this->form_validation->set_rules('produto_altura', 'Altura do produto', 'trim|required|integer');
                $this->form_validation->set_rules('produto_comprimento', 'Comprimento do produto', 'trim|required|integer');
                $this->form_validation->set_rules('produto_quantidade_estoque', 'Quantidade em estoque', 'trim|required|integer');


                if($this->form_validation->run()) {
                    $data = elements(
                        array(
                            'produto_nome',
                            'produto_valor',
                            'produto_largura',
                            'produto_categoria_id',
                            'produto_marca_id',
                            'produto_descricao',
                            'produto_ativo',
                            'produto_peso',
                            'produto_altura',
                            'produto_comprimento',
                            'produto_quantidade_estoque'
                        ), $this->input->post()
                    );
                    //removendo virgula
                    $data['produto_valor'] = str_replace(',','',$data['produto_valor']);

                    //criando metalink
                    $data['produto_meta_link'] = url_amigavel($data['produto_nome']);

                    // produto codigo gerado


                    $data = html_escape($data);
                    
                    // echo '<pre>';
                    // print_r($data);
                    // die();

                    $this->core_model->update('produtos', $data, array('produto_id'=> $produto_id));

                    // Exclui as imagens antiga do produto

                    $this->core_model->delete('produtos_fotos',array('foto_produto_id'=>$produto_id));

                    $fotos_produtos = $this->input->post('fotos_produtos'); 
                    if($fotos_produtos){

                           $total_fotos = count($fotos_produtos);
                    for($i=0; $i <$total_fotos; $i++){
                        $data = array(
                            'foto_produto_id' => $produto_id,
                            'foto_caminho' => $fotos_produtos[$i],
                        );
                        $this->core_model->insert('produtos_fotos',$data);
                    }

                    }

                 

                    redirect('restrita/produtos');

                } else {


                    $data = array(

                        'titulo' => 'Editar produto',
                        'styles' => array(
                            'jquery-upload-file/css/uploadfile.css',
                        ),

                        'scripts' => array(
                            'sweetalert2/sweetalert2.all.min.js',
                            'jquery-upload-file/js/jquery.uploadfile.min.js',
                            'jquery-upload-file/js/produtos.js',
                            'mask/jquery.mask.min.js',
                            'mask/custom.js'
                        ),
                        'produto' => $produto,


                        'fotos_produtos' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),
                        'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                        'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1)),
                    );


                            // echo '<pre>';
                            // print_r($data['produto']);
                            // die;

                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/produtos/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }



    public function valida_nome_produto($produto_nome){
    
        $produto_id = $this->input->post('produto_id');
        
        if (! $produto_id){
            //cadastrando

            if ($this->core_model->get_by_id('produtos', array('produto_nome'=> $produto_nome))){
                $this->form_validation->set_message('valida_nome_produto','Esse produto ja existe');
                return false;
            }else{
                return true;
            }

        }else{
            //Editando

            if ($this->core_model->get_by_id('produtos', array('produto_nome'=> $produto_nome, 'produto_id !=' => $produto_id))){
                $this->form_validation->set_message('valida_nome_produto','Esse produto ja existe');
                return false;
            }else{
                return true;
            }
    }
    }

    public function upload()
    {

        $config['upload_path'] = './uploads/produtos/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
        $config['max_width'] = 1000;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 200;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_produto')) {

            $data = array(

                'uploaded_data' => $this->upload->data(),
                'mensagem' => 'Imagem enviada com sucesso',
                'foto_caminho' => $this->upload->data('file_name'),
                'erro' => 0,
            );

            //resize image configuração


            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/produtos/'.$this->upload->data('file_name');
            $config['new-image'] = './uploads/produtos/small/'.$this->upload->data('file_name');
            $config['width'] = 300;
            $config['height'] = 300;

            //chama a biblioteca
            $this->load->library('image_lib', $config);

            //faz o resize 
            //$this->image_lib->resize();

            if($this->image_lib->resize()) { // é o !!!!
                $data['erro'] = $this->image_lib->display_errors();
            }
        } else {

            $data = array(
                'mensagem' => $this->upload->display_errors(),
                'erro' => 5,
            );
        }
        echo json_encode($data);
    }
    public function delete($produto_id= NULL){

        $produto_id= (int) $produto_id;

        if(!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
            $this->session->set_flashdata('erro', 'A produto  não foi encontrado');
                redirect('restrita/produtos');
        }

        if($this->core_model->get_by_id('produtos', array('produto_id ' => $produto_id, 'produto_ativo' => 1))){
            $this->session->set_flashdata('erro', 'Não é possivel excluir um produto ativaAAAAAAAAAAAAAAAAA');
                redirect('restrita/produtos');
        }
        
        //recuprando fotos
        $fotos_produtos= $this->core_model->get_all('produtos_fotos',array('foto_produto_id'=> $produto_id));

        
        $this->core_model->delete('produtos',array('produto_id'=>$produto_id));



        // apagando as fotos do produtos
        if($fotos_produtos){
        foreach($fotos_produtos as $foto){
            $foto_grande = FCPATH.'uploads/produtos/'.$foto->foto_caminho;
            $foto_pequena=FCPATH.'uploads/produtos/small'.$foto->foto_caminho;

            // excluidando as imagens
            if(file_exists($foto_grande) || file_exists($foto_pequena)){
                unlink($foto_grande);
                unlink($foto_pequena);
            }

        }
      
    }
    redirect('restrita/produtos'); 
}
}