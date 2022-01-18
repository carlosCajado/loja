<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>

<!-- Main Content -->
<div class="main-content">
<section class="section">
  <div class="section-body">
    <!-- add content here -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><?php echo $titulo; ?></h4>
            </div>

            <?php 

              $atributos = array(
                'name' => 'form_core',

              );

              if(isset($marca)){
                $marca_id = $marca->marca_id;
              }else {
                $marca_id = '';
              }

            ?>

            <?php echo form_open('restrita/marcas/core/'.$marca_id, $atributos); ?>

              <div class="card-body">
                <div class="form-row">

                  <div class="form-group col-md-4">
                    <label>Nome da Marca</label>
                    <input type="text" name="marca_nome"class="form-control" value="<?php echo (isset($marca)? $marca->marca_nome : set_value('marca_nome'));?>" > 
                    <?php echo form_error('marca_nome','<div class="text-danger">', '</div>')?>
                  </div>

                  <div class="form-group col-md-4">
                      <label for="inputState">Ativa</label>
                      <select id="inputState" name="marca_ativa" class="form-control">
                        
                        <?php if(isset($marca)): ?>

                          <option value="1" <?php echo ($marca->marca_ativa == 1 ? 'selected': ''); ?>>Sim</option>
                          <option value="0" <?php echo ($marca->marca_ativa == 0 ? 'selected': ''); ?>>Não</option>

                        <?php else: ?>
                          
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                          
                        <?php endif; ?>

                      </select>
                  </div>

                    <?php if(isset($marca)): ?>

                      <div class="form-group col-md-4">
                        <label>Metalink da Marca</label>
                        <input type="text" name="marca_meta_link"class="form-control border-0" value="<?php echo $marca->marca_meta_link;?>" readonly="" > 
                      </div>
                    
                    <?php endif; ?>

                    </div>

                    <?php if (isset($marca)): ?>
                        <input type="hidden" name="marca_id" value="<?php echo $marca->marca_id; ?>">
                    <?php endif; ?>


                </div>

                
              <div class="card-footer">
                <button class="btn btn-primary mr-2">Salvar</button>
                <a class="btn btn-dark" href="<?php echo base_url('restrita/marcas');?>">Voltar</a>
              </div>

          </div>

            <?php echo form_close(); ?>

      </div>
    </div>
  </div>
</section>
<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>