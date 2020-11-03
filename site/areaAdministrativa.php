<?php

require_once "lib/Seguranca.php";
    
// Verifica se o usuário está logado para continuar

Seguranca::esta_logado( 1 );

//
    
require_once 'lib/Formulario.php';
require_once "modelContatos.php";

$model = new modelContatos();

$dados = $model->buscaNovosContatos($conDb);
?>

<section class="adm-area pTitle Padrao">
    <div class="pb-5 container">
        <div class="col-md-12 mb-3">
            <a href="<?= SITE_URL ?>listaPortifolio" class="btn btn-primary w-100">Editar Portifólio</a>
        </div>
        <div class="col-md-12 mb-3">
            <a href="<?= SITE_URL ?>listaSlides" class="btn btn-success w-100">Editar Slides</a>
        </div>
        <div class="col-md-12 mb-3">
            <a href="<?= SITE_URL ?>listaCategoria" class="btn btn-warning w-100">Editar Categorias</a>
        </div>
        <div class="col-md-12 mb-3">
            <a class="btn btn-danger w-100" href="<?= SITE_URL ?>listaContato">Contatos <span class="badge badge-light"><?= $dados->NovosRegistros ?></span>
  <span class="sr-only">Mensagens não lidas</span></a>
        </div>
        <div class="col-md-12 mb-3">
            <a href="<?= SITE_URL ?>listaUsuario" class="btn btn-dark w-100">Usuários</a>
        </div>
    </div>
</section>  

