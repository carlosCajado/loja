<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Ajax extends CI_Controller {
    	//habilida o word limited
	public function __construct(){
		parent::__construct();
		
	}

    public function index(){
        
        $this->form_validation->set_rules('cep', 'CEP Destino', 'trim|required|exact_length[9]' );
        $this->form_validation->set_rules('produto_id', 'Produto ID', 'trim|required' );

        $retorno = array();

        if($this->form_validation->run()){
            $cep = str_replace('-','', $this->input->post('cep'));

            $url_edereco_cep = 'https://viacep.com.br/ws/'.$cep.'/json/';
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl,CURLOPT_URL, $url_edereco_cep);
            $resposta_api_cep = curl_exec($curl);

            $resposta_api_cep = json_decode($resposta_api_cep);

            if(isset($resposta_api_cep->erro)){
                $retorno['erro'] = 3;
                $retorno['mensagem'] = 'CEP informado não encontrado, tente novamente.';
                $retorno['resposta_api_cep'] = 'CEP Invalido, tente novamente.';

            }else{
                //"erro":0,"mensagem":"Sucesso","resposta_api_cep ":{"cep":"65061-510","logradouro":"Avenida Perimetral Norte","complemento":"","bairro":"Bequimão","localidade":"São Luís","uf":"MA","ibge":"2111300","gia":"","ddd":"98","siafi":"0921"}}

                $retorno['erro'] = 0;
                $retorno['mensagem'] = 'Sucesso';
                $retorno['resposta_api_cep'] = $resposta_api_cep->logradouro.', '.$resposta_api_cep->bairro.',  '.$resposta_api_cep->localidade.'-'.$resposta_api_cep->uf;    

            }
        }else{
            $retorno['erro'] = 1;
            $retorno['mensagem'] = validation_errors();

        }
         
         
        echo json_encode( $retorno);
    }

}