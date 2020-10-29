<?php


require_once 'lib\Formulario.php';
require_once $pasta . '/modelPortifolio.php';

$model = new modelPortifolio();
$dados = $model->buscaCodPostagem($conDb, $id);
$categorias = $model->buscaCategoria($conDb);

$descricao = Formulario::set_value("Descricao");

?>

<section class="pTitle mb-5 container">

    <div class="row mb-3">

        <div class="col-10">

            <h3>Postagem - <?= Formulario::form_sub_titulo($acao) ?><h3>

        </div>

        <div class="col-2" style="padding-top: 25px; text-align: right;">

            <a href="<?= SITE_URL . "listaUsuario" ?>" title="Lista de Usuário"><i class="ti-layout-grid3 custom_botao"></i></a>

        </div>

    </div>
    <form action="<?= SITE_URL . "controllerPortifolio/" . Formulario::formAcao($acao) ?>" method="POST" class="form" 
        name="formPublicacao" id="formPublicacao" enctype="multipart/form-data">

        <div class="form-row">
            <div class="form-group col-md-1">
                <label for="codPublicacao">Código</label>
                <input type="number" disabled class="form-control" name="codPublicacao" id="codPublicacao" 
                           value="<?= Formulario::set_value( "codPublicacao", 0 ) ?>">
            </div>
            <div class="form-group col-md-5">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="<?= Formulario::set_value( "Titulo", "" ) ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="subTitulo">Sub-Título</label>
                <input type="text" class="form-control" name="subTitulo" id="subTitulo"
                value="<?= Formulario::set_value( "SubTitulo", "" ) ?>">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria" id="categoria">
                    <option value="" disabled selected>Selecione...</option>
                    <?php

                    if ($categorias) {

                        foreach ($categorias as $key => $value) {
                    ?>
                            <option value="<?= $value->codCategoria ?>"<?= ( Formulario::set_value( "codCategoria") == $value->codCategoria  ? 'selected="selected"' : "" ) ?>><?= $value->Descricao ?></option>

                    <?php

                        }
                    } ?>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="StatusPostagem">Status da Postagem</label>
                <select name="StatusPostagem" id="StatusPostagem" class="form-control">
                    <option  disabled value="" <?= ( Formulario::set_value( "StatusPostagem") == ""  ? 'selected="selected"' : "" ) ?>>Selecione...</option>
                    <option <?= ( Formulario::set_value( "StatusPostagem") == "H"  ? 'selected="selected"' : "" ) ?> value="H">Habilitada</option>
                    <option <?= ( Formulario::set_value( "StatusPostagem") == "D"  ? 'selected="selected"' : "" ) ?> value="D">Desabilitada</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="descricao">Descrição</label>
                <textarea required name="descricao" id="informacoes" cols="30" rows="7" class="form-control" >
                    <?= $descricao ?>
                </textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="img01">Imagem da Capa: </label>
                <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="img01" id="img01">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="img02">Imagem 01: </label>
                <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="img02" id="img02">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="img03">Imagem 02: </label>
                <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="img03" id="img03">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="img04">Imagem 03: </label>
                <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="img04" id="img04">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="img05">Imagem 04: </label>
                <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="img05" id="img04">
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
</section>