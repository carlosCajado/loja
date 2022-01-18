<?php 
defined('BASEPATH') OR exit('Ação não permitida');

class Core_model extends CI_Model{
    public function get_all($tabela = null, $condicoes = null){
        if($tabela && $this->db->table_exists($tabela)){
            if (is_array($condicoes)){
                $this->db->where($condicoes);
            }
            return $this->db->get($tabela)->result();
        }else{
            return false;
            }
      }
    public function get_by_id($tabela = null, $condicoes = null){
        if($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){
            $this->db->where($condicoes);
            $this->db->limit(1);
            return $this->db->get($tabela)->row();

        }else{
            return false;
            }
        
          
    }
    public function insert($tabela = null, $data = null, $get_last_id = null){
        if($tabela && $this->db->table_exists($tabela) && is_array($data)){
            //INSERE O ULTIMO ID INSERIDO NA BASE  DE DASOS
           
            $this->db->insert($tabela,$data);

            if($get_last_id){
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if($this->db->affected_rows()>0){
                $this->session->set_flashdata('sucesso','Dados salvos com sucesso!' );
            }else{
                $this->session->set_flashdata('Erro','não foi possivel salvar os dados' );
            }

        }else{
            return false;
        }


    }
    
    public function update($tabela = null, $data = null, $condicoes = null){
        if($tabela && $this->db->table_exists($tabela) && is_array($data) && is_array($condicoes)){
            if($this->db->update($tabela, $data, $condicoes)){
                $this->session->set_flashdata('sucesso','Dados salvos com sucesso!' );


            }else{
                $this->session->set_flashdata('Erro','não foi possivel salvar os dados' );
            }

        }else{
            return false;
        }


    }
    public function delete($tabela = NULL, $condicoes = NULL){

        if ($tabela && $this->db->table_exists($tabela) && is_array($condicoes)){

            if($this->db->delete($tabela, $condicoes)){
                
                $this->session->set_flashdata('sucesso','Registro excluidos com sucesso!');
            }else{
                $this->session->set_flashdata('erro','Não foi possivel excluir os dados');
            }
        }else{
            return false;
        }
    }
    public function generate_unique_code($tabela= NULL, $tipo_codigo = NULL, $tamnho_codigo = NULL, $campo_procura = NULL){

            do{
                $codigo= random_string($tipo_codigo,$tamnho_codigo);
                $this->db->where($campo_procura,$codigo);

                $this->db->from($tabela);
            }while($this-> db -> count_all_results()>=1);

            return $codigo;
        
    }
    
}