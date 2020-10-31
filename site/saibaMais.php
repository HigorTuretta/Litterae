<?php

require_once 'lib/Formulario.php';
require_once $pasta . '/modelPortifolio.php';

$model = new modelPortifolio();
$dados = $model->buscaCodPostagem($conDb, $id);

$descricao = Formulario::set_value("Descricao");

?>


<section class="pTitle Padrao">
    <div>
        <h2 class="text-center"><?= Formulario::set_value("Titulo", "") ?></h2>
    </div>
    <hr class="Linha">
    <div class="mb-4">
        <h4 class="text-center"><?= Formulario::set_value("SubTitulo", "") ?></h4>
    </div>
    <hr class="Linha">
    <div class="container mb-5">
        <div class="col-md-12">
            <?= $descricao ?>
        </div>
    </div>


    <div class="">
        <div class="read-more-images">
            <img src="<?= SITE_URL . "assets/images/blog/" . Formulario::set_value("Img1", "") ?>" alt="Imagem 01">

            <img src="<?= SITE_URL . "assets/images/blog/" . Formulario::set_value("ImgCapa", "") ?>" alt="Imagem 02">
        </div>
        <div class="read-more-images">
            <img src="<?= SITE_URL . "assets/images/blog/" . Formulario::set_value("Img3", "") ?>" alt="Imagem 03">

            <img src="<?= SITE_URL . "assets/images/blog/" . Formulario::set_value("Img4", "") ?>" alt="Imagem 04">
        </div>
    </div>
    <!-- WPP LINK  -->
    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=5532999385459" target="blank"><i class="fab fa-whatsapp"></i></a>
    <!-- WPP LINK -->
</section>