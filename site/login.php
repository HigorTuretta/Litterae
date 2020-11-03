<?php
/*
 *  Login
 */
?>

<section class="Padrao section-margin">
      
    <div class="container">
        
        <div class="section-intro mb-75px">
            <h4 class="intro-title">Área Administrativa</h4>
        </div>   
        
      <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <form class="form-contact contact_form" action="<?= SITE_URL . "controllerUsuario/efetuarLogin" ?>" method="post" id="loginForm" novalidate="novalidate">
            <div class="row">

                <div class="col-sm-12">
                    <h4 class="intro-title">Acesso</h4>
                </div>        
                
                <div class="col-sm-12">
                <div class="form-group">
                    <input class="form-control" name="Login" id="Login" 
                           type="text" 
                           placeholder="Informe o login"
                           required>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                    <input class="form-control" name="Senha" id="Senha" 
                           type="password" placeholder="Sua senha" required>
                </div>
              </div>
            </div>
                
            <?php
                if (isset($_SESSION["msgError"])) {
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION["msgError"] ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    unset($_SESSION["msgError"]);
                }
            ?>
            <div class="form-group mt-3">
              <button type="submit" class="btn btn-outline-success">Acessar</button>
            </div>
          </form>

        </div>

    </div>
  </section>