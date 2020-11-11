<?php
require_once "lib/Seguranca.php";
    
// Verifica se o usuário está logado para continuar

Seguranca::esta_logado( 1 );

//

require_once 'lib/Formulario.php';
require_once $pasta . '/modelCategorias.php';

$model = new modelCategorias();
$dados = $model->buscaCodCategoria($conDb, $id);

?>
<section class="Padrao">
    <div class="pTitle mb-5 container">

        <div class="row mb-3">

            <div class="col-10">

                <h3>Categorias - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaCategoria" ?>" title="Lista de Categorias"><i class="fas fa-list"></i></a>

            </div>

        </div>
        <form action="<?= SITE_URL . "controllerCategorias/" . Formulario::formAcao($acao) ?>" method="POST" class="form" name="formCategorias" id="formCategorias" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="codCategoria">Código</label>
                    <input type="number" readonly="readonly" class="form-control" name="codCategoria" id="codCategoria" value="<?= Formulario::set_value("codCategoria", 0) ?>">
                </div> 
                <div class="form-group col-md-5">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" name="descricao" id="descricao" value="<?= Formulario::set_value("Descricao", "") ?>">
                </div>                          
                <div class="form-group col-md-5">
                    <label for="statusCategoria">Status da Categoria</label>
                    <select required name="statusCategoria" id="statusCategoria" class="form-control">
                        <option disabled value="" <?= (Formulario::set_value("StatusCategoria") == ""  ? 'selected="selected"' : "") ?>>Selecione...</option>
                        <option <?= (Formulario::set_value("StatusCategoria") == "A"  ? 'selected="selected"' : "") ?> value="A">Ativa</option>
                        <option <?= (Formulario::set_value("StatusCategoria") == "I"  ? 'selected="selected"' : "") ?> value="I">Inativa</option>
                    </select>
                </div>
            </div>     

            <a class="btn btn-danger" href="<?= SITE_URL ?>listaCategoria">Voltar</a>
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