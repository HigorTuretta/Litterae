<?php
require_once "lib/Seguranca.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once 'lib/Formulario.php';
require_once $pasta . '/modelPortifolio.php';
require_once $pasta . '/modelCategorias.php';

$model = new modelPortifolio();
$modelCategorias = new modelCategorias();

$dados = $model->buscaCodPostagem($conDb, $id);
$categorias = $modelCategorias->buscaCategoriaAtivas($conDb);

$descricao = Formulario::set_value("Descricao");

?>
<section class="Padrao">
    <div class="pTitle mb-5 container">

        <div class="row mb-3">

            <div class="col-10">

                <h3>Postagem - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaPortifolio" ?>" title="Lista de Postagens"><i class="fas fa-list"></i></a>

            </div>

        </div>
        <form action="<?= SITE_URL . "controllerPortifolio/" . Formulario::formAcao($acao) ?>" method="POST" class="form" name="formPublicacao" id="formPublicacao" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="CodPublicacao">Código</label>
                    <input type="number" readonly="readonly" class="form-control" name="CodPublicacao" id="CodPublicacao" value="<?= Formulario::set_value("codPublicacao", 0) ?>">
                </div>
                <div class="form-group col-md-5">
                    <label for="titulo">Título</label>
                    <input type="text" required class="form-control" name="titulo" id="titulo" value="<?= Formulario::set_value("Titulo", "") ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="subTitulo">Sub-Título</label>
                    <input required type="text" class="form-control" name="subTitulo" id="subTitulo" value="<?= Formulario::set_value("SubTitulo", "") ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="categoria">Categoria</label>
                    <select required class="form-control" name="categoria" id="categoria">
                        <option value="" disabled selected>Selecione...</option>
                        <?php

                        if ($categorias) {

                            foreach ($categorias as $key => $value) {
                        ?>
                                <option value="<?= $value->codCategoria ?>" <?= (Formulario::set_value("codCategoria") == $value->codCategoria  ? 'selected="selected"' : "") ?>><?= $value->Descricao ?></option>

                        <?php

                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="StatusPostagem">Status da Postagem</label>
                    <select required name="StatusPostagem" id="StatusPostagem" class="form-control">
                        <option disabled value="" <?= (Formulario::set_value("StatusPostagem") == ""  ? 'selected="selected"' : "") ?>>Selecione...</option>
                        <option <?= (Formulario::set_value("StatusPostagem") == "H"  ? 'selected="selected"' : "") ?> value="H">Habilitada</option>
                        <option <?= (Formulario::set_value("StatusPostagem") == "D"  ? 'selected="selected"' : "") ?> value="D">Desabilitada</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição</label>
                    <textarea required name="descricao" id="informacoes" cols="30" rows="7" class="form-control">
                    <?= $descricao ?>
                </textarea>
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="ImgCapa">Imagem da Capa (480x360): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="ImgCapa" id="ImgCapa">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirCapa" value="<?= trim(Formulario::set_value("ImgCapa", "")) ?>">
                    <img class="form-images" name="" src="<?= SITE_URL . "assets/images/blog/" . Formulario::set_value("ImgCapa", "") ?>" alt="" srcset="">
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Img1">Imagem 01 (450x450): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Img1" id="Img1">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImg1" value="<?= trim(Formulario::set_value("Img1", "")) ?>">
                    <img class="form-images" src="<?= SITE_URL . "assets/images/blog/" . trim(Formulario::set_value("Img1", "")) ?>" alt="" srcset="">
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Img2">Imagem 02 (450x450): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Img2" id="Img2">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImg2" value="<?= trim(Formulario::set_value("Img2", "")) ?>">
                    <img class="form-images" src="<?= SITE_URL . "assets/images/blog/" . trim(Formulario::set_value("Img2", "")) ?>" alt="" srcset="">
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Img3">Imagem 03 (450x450): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Img3" id="Img3">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImg3" value="<?= trim(Formulario::set_value("Img3", "")) ?>">
                    <img class="form-images" src="<?= SITE_URL . "assets/images/blog/" . trim(Formulario::set_value("Img3", "")) ?>" alt="" srcset="">
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Img4">Imagem 04 (450x450): </label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Img4" id="Img4">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImg4" value="<?= trim(Formulario::set_value("Img4", "")) ?>">
                    <img class="form-images" src="<?= SITE_URL . "assets/images/blog/" . trim(Formulario::set_value("Img4", "")) ?>" alt="" srcset="">
                </div>
            </div>

            <a class="btn btn-danger" href="<?= SITE_URL ?>listaPortifolio">Voltar</a>
            <?php
            if ($acao != "visualizar") {
            ?>
                <button name="btEnviar" id="btEnviar" class="btn btn-success" type="submit">Gravar</button>
            <?php
            }
            ?>
        </form>
        <script type="text/javascript">
            window.onload = function() {
                CKEDITOR.replace('informacoes')
            }
        </script>
    </div>
</section>