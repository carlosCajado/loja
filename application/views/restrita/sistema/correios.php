

    <?php $this->load->view('restrita/layout/navbar');?>
    <?php $this->load->view('restrita/layout/sidebar');?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div>
          <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $titulo; ?></h4>
                  </div>
                  <?php echo form_open('restrita/sistema/correios');?>
                    <div class="card-body">

                    <?php if($mensagem = $this->session->flashdata('sucesso')): ?>
                      <div class="alert alert-success alert-dismissible alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="alert-body">
                        <div class="alert-title">DEU BOM !!</div>
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          <?php echo $mensagem; ?>
                        </div>
                    </div>

                    <?php endif; ?>

                    <?php if($mensagem = $this->session->flashdata('erro')): ?>
                      <div class="alert alert-danger alert-dismissible alert-has-icon">
                      <div class="alert-icon"><i class="fas fa-dizzy"></i></div>
                        <div class="alert-body">
                        <div class="alert-title">Erro</div>
                          <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                          </button>
                          <?php echo $mensagem; ?>
                        </div>
                    </div>

                    <?php endif; ?>

                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <label >CEP De origem</label>
                            <input type="text" name="config_cep_origem" class="form-control cep" value="<?php echo (isset($correio) ? $correio->config_cep_origem: set_value('config_cep_origem'));?>">
                            <?php echo form_error('config_cep_origem', '<div class="text-danger">','</div>'); ?>
                          </div>

                          <div class="form-group col-md-2">
                            <label >Cod PAC</label>
                            <input type="text" name="config_codigo_pac" class="form-control codgo_servico_correios" value="<?php echo (isset($correio) ? $correio->config_codigo_pac: set_value('config_codigo_pac'));?>">
                            <?php echo form_error('config_codigo_pac', '<div class="text-danger">','</div>'); ?>
                          </div>
                          <div class="form-group col-md-2">
                            <label >Cod SEDEX</label>
                            <input type="text" name="config_codigo_sedex" class="form-control codgo_servico_correios"  value="<?php echo (isset($correio) ? $correio->config_codigo_sedex: set_value('config_codigo_sedex'));?>">
                            <?php echo form_error('config_codigo_sedex', '<div class="text-danger">','</div>'); ?>
                          </div>
                          <div class="form-group col-md-2">
                            <label >Valor para somar ao frete</label>
                            <input type="text" name="config_somar_frete" class="form-control money2" value="<?php echo (isset($correio) ? $correio->config_somar_frete: set_value('config_somar_frete'));?>">
                            <?php echo form_error('config_somar_frete', '<div class="text-danger">','</div>'); ?>
                          </div>
                          <div class="form-group col-md-2">
                            <label >Valor Declarado</label>
                            <input type="text" name="config_valor_declarado" class="form-control money2" value="<?php echo (isset($correio) ? $correio->config_valor_declarado: set_value('config_valor_declarado'));?>">
                            <?php echo form_error('config_valor_declarado', '<div class="text-danger">','</div>'); ?>
                          </div>
                        </div> 
                        <div class="card-footer">
                        <button class="btn btn-primary">Salvar</button>
                      </div>
                    <?php echo form_close();?>
                    </div>
                    </div>         
                      </div>
                  </div>
            </div>
            
         </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_settings');?>
      </div>
    