<?php

require_once 'lib/Formulario.php';
require_once $pasta . '/modelSite.php';

$model = new modelSobreNos();
$dados = $model->buscaSobreNos($conDb);

$descricao = $dados->Descricao;

?>

<section class="sobreNos-section control-height Padrao">
    <div class="sobreNos-title">
        <h2 class="text-fluid"><?= $dados->Titulo ?></h2>
    </div>
    <div class="container">
        <div class="row sobreNos-description">
            <div class="col-lg-4 ">
                <img src="<?= SITE_URL . "assets/images/" . $dados->Imagem ?>" alt="Oi, Sou a Sara!">
            </div>
            <div class="col-lg-8">
                <?= $descricao ?>
            </div>
        </div>
    </div>
</section>