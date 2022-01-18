

    <?php $this->load->view('restrita/layout/navbar');?>
    <?php $this->load->view('restrita/layout/sidebar');?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div>
          <div class="col-12">
                <div class="card">
                  <div class="card-header d-block">
                    <h4><?php echo $titulo; ?></h4>
                    <a class="btn btn-primary float-right" href="<?php echo base_url('restrita/marcas/core');?>">Cadastrar</a>
                  </div>
                  <div class="card-body">

                  <?php if($mensagem = $this->session->flashdata('Sucesso')): ?>
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

                    <div class="table-responsive">
                      <table class="table table-striped data-table">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nome da marca</th>
                            <th>Meta link da marca</th>
                            <th>Data de cadastro</th>
                            <th>Ativa</th>
                            <th class="nosort">Ação</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($marcas as $marca):?>
                          <tr>

                              <td><?php echo $marca->marca_id; ?></td>
                              <td><?php echo $marca->marca_nome?></td>
                              <td><i data-feather="link"></i>&nbsp;<?php echo $marca->marca_meta_link; ?></td>
                              <td><?php echo formata_data_banco_com_hora($marca->marca_data_criacao); ?></td>
                              <td><?php echo ($marca->marca_ativa == 1 ? '<span class="badge badge-success">SIM</span>':'<span class="badge badge-danger">Não</span>'); ?></td>
                        
                            <td>
                            <a href="<?php echo base_url('restrita/marcas/core/'.$marca->marca_id); ?>" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a>
                            <a href="<?php echo base_url('restrita/marcas/delete/'.$marca->marca_id); ?>" class="btn btn-icon btn-danger delete" data-confirm="Deseja apagar a Marca?"><i class="fas fa-times"></i></a>
                            </td>

                          </tr>
                        <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_settings');?>
      </div>
    