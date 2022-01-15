<?php ?>
<style>


body{

  background-image: linear-gradient(to right, #021373, #0D0D0D)
}
img.logo{
  display: block;
    margin-left: auto;
    margin-right: auto
}
</style>

    <section class="section">
      
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">

              <div class="card-header">
                <h4><?php echo $titulo; ?>
                <img class="logo" src="/loja/public/assets/img/image-gallery/LOGO.png" width="50%"></h4>
              </div>
              <div class="card-body">
                <?php
                $atributo = array(
                  'class' => 'needs-validation'
                );
                ?>
                <?php
                echo form_open('restrita/login/auth');
                ?>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Digite seu email
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Senha</label>
                      <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Esqueceu a senha?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Digite sua senha
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Lembre-me</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Entrar
                    </button>
                  </div>
                  <?php echo form_close();?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>