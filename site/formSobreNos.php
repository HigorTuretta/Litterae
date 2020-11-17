<?php
require_once "lib/Seguranca.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once 'lib/Formulario.php';
require_once $pasta . '/modelSite.php';

$model = new modelSobreNos();


$dados = $model->buscaCodSobre($conDb, $id);


if (sizeof($dados) >= 1) {

    $_SESSION["msgError"] = "Limite de registros atingido!";
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaSobreNos";
    </script>
<?php
}

$descricao = Formulario::set_value("Descricao");

?>
<section class="Padrao">
    <div class="pTitle mb-5 container">

        <div class="row mb-3">

            <div class="col-10">

                <h3>Sobre Nós - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaSobreNos" ?>" title="Lista Sobre Nós"><i class="fas fa-list"></i></a>

            </div>

        </div>
        <form action="<?= SITE_URL . "controllerSobreNos/" . Formulario::formAcao($acao) ?>" method="post" class="form" name="formSobre" id="formSobre" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="codSobre">Código</label>
                    <input type="number" readonly="readonly" class="form-control" name="codSobre" id="codSobre" value="<?= Formulario::set_value("codSobre", 0) ?>">
                </div>
                <div class="form-group col-md-5">
                    <label for="titulo">Título</label>
                    <input type="text" required class="form-control" name="titulo" id="titulo" value="<?= Formulario::set_value("Titulo", "") ?>">
                </div>
                <div class="form-group col-md-5">
                    <label for="dataPublicacao">Data de Publicação</label>
                    <input type="text" readonly class="form-control" name="dataPublicacao" id="dataPublicacao" value="<?= Formulario::set_value("dataPublicacao", "") ?>">
                </div>
            </div>
            <div class="form-row form-files">
                <div class="form-group col-md-6">
                    <label for="Imagem">Imagem</label>
                    <input accept="image/png, image/jpg, image/jpeg, image/gif" type="file" name="Imagem" id="Imagem">
                </div>
                <div class="form-group col-md-6">
                    <input type="hidden" name="ExcluirImagem" value="<?= trim(Formulario::set_value("Imagem", "")) ?>">
                    <img class="form-images" name="" src="<?= SITE_URL . "assets/images/" . Formulario::set_value("Imagem", "") ?>">
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


            <a class="btn btn-danger" href="<?= SITE_URL ?>listaSobreNos">Voltar</a>
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