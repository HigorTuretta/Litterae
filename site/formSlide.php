<?php
require_once "lib/Seguranca.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once 'lib/Formulario.php';
require_once $pasta . '/modelSite.php';

$model = new modelSlides();
$dados = $model->buscaCodSlides($conDb, $id);

?>
<section class="Padrao">
    <div class="pTitle mb-5 container">

        <div class="row mb-3">

            <div class="col-10">

                <h3>Slides - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaSlides" ?>" title="Lista de Slides"><i class="fas fa-list"></i></a>

            </div>

        </div>
        <form action="<?= SITE_URL . "controllerSlides/" . Formulario::formAcao($acao) ?>" method="POST" class="form" name="formSlides" id="formSlides" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="codSlide">Código</label>
                    <input type="number" readonly="readonly" class="form-control" name="codSlide" id="codSlide" value="<?= Formulario::set_value("codSlide", 0) ?>">
                </div>
                <div class="form-group col-md-2">
                    <label for="StatusSlide">Status do Slide</label>
                    <select required name="StatusSlide" id="StatusSlide" class="form-control">
                        <option disabled value="" <?= (Formulario::set_value("StatusSlide") == ""  ? 'selected="selected"' : "") ?>>Selecione...</option>
                        <option <?= (Formulario::set_value("StatusSlide") == "H"  ? 'selected="selected"' : "") ?> value="H">Habilitada</option>
                        <option <?= (Formulario::set_value("StatusSlide") == "D"  ? 'selected="selected"' : "") ?> value="D">Desabilitada</option>
                    </select>
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Imagem">Imagem (1200x600): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Imagem" id="Imagem">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImagem" value="<?= trim(Formulario::set_value("Imagem", "")) ?>">
                    <img class="form-images" name="" src="<?= SITE_URL . "assets/images/slides/" . Formulario::set_value("Imagem", "") ?>" alt="" srcset="">
                </div>
            </div>

            <a class="btn btn-danger" href="<?= SITE_URL ?>listaSlides">Voltar</a>
            <?php
            if ($acao != "visualizar") {
            ?>
                <button name="btEnviar" id="btEnviar" class="btn btn-success" type="submit">Gravar</button>
            <?php
            }
            ?>
        </form>
    </div>
</section>