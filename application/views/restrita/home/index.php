

    <?php $this->load->view('restrita/layout/navbar');?>
    <?php $this->load->view('restrita/layout/sidebar');?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            
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
          </div>
        </section>
        <?php $this->load->view('restrita/layout/sidebar_settings');?>
      </div>
    