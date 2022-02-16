

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
                  <?php echo form_open('restrita/sistema/pagseguro');?>
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
                          <div class="form-group col-md-4">
                            <label >Email acesso</label>
                            <input type="text" name="config_email" class="form-control" value="<?php echo (isset($pagseguro) ? $pagseguro->config_email: set_value('config_email'));?>">
                            <?php echo form_error('config_email', '<div class="text-danger">','</div>'); ?>
                          </div>

                          <div class="form-group col-md-4">
                            <label >TOKEN DE ACESSO</label>
                            <input type="text" name="config_token" class="form-control" value="<?php echo (isset($pagseguro) ? $pagseguro->config_token: set_value('config_token'));?>">
                            <?php echo form_error('config_token', '<div class="text-danger">','</div>'); ?>
                          </div>
                          <div class="form-group col-md-2">
                      <label>Ambiente</label>
                      <select name="config_ambiente" class="form-control">
                        
                        <?php if(isset($pagseguro)): ?>

                          <option value="1" <?php echo ($pagseguro->config_ambiente == 1 ? 'selected': ''); ?>>Sandbox</option>
                          <option value="0" <?php echo ($pagseguro->config_ambiente == 0 ? 'selected': ''); ?>>Produção</option>

                        <?php else: ?>
                          
                          <option value="1">Sandbox</option>
                          <option value="0">Produção</option>
                          
                        <?php endif; ?>

                      </select>
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
    