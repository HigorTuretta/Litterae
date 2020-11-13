<?php

require_once "lib/Seguranca.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once 'lib/Formulario.php';
require_once 'modelUsuario.php';

$model = new modelUsuario();
$dados = $model->buscaUsuarioID($conDb, $id);

?>
<section class="Padrao">
    <div class="container">

        <div class="row">

            <div class="col-10">

                <h3>Cadastro de Usuário - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaUsuario" ?>" title="Lista de Usuário"><i class="fas fa-list"></i></a>

            </div>

        </div>

        <form action="<?= SITE_URL . "controllerUsuario/" . Formulario::formAcao($acao) ?>" method="post" class="form" name="formUsuario" id="formUsuario" enctype="multipart/form-data">

            <div class="row">

                <div class="control-group col-12 col-sm-2">

                    <div class="control-label">
                        <label for="CodUsuario">Código</label>
                    </div>

                    <div class="controls">

                        <input type="text" class="form-control" id="CodUsuario" name="CodUsuario" readonly="readonly" value="<?= Formulario::set_value("CodUsuario", 0) ?>" />

                    </div>

                </div>

                <div class="control-group col-xs-12 col-sm-4">

                    <div class="control-label">
                        <label for="StatusCadastro">Status</label>
                    </div>

                    <div class="controls">

                        <select class="form-control" id="StatusCadastro" name="StatusCadastro" required="required">
                            <option value="" <?= (Formulario::set_value("StatusCadastro") == ""  ? 'selected="selected"' : "") ?>>Selecione o Status</option>
                            <option value="0" <?= (Formulario::set_value("StatusCadastro") == "0" ? 'selected="selected"' : "") ?>>Inativo</option>
                            <option value="1" <?= (Formulario::set_value("StatusCadastro") == "1" ? 'selected="selected"' : "") ?>>Ativo</option>
                            <option value="2" <?= (Formulario::set_value("StatusCadastro") == "2" ? 'selected="selected"' : "") ?>>Bloqueado</option>
                        </select>

                    </div>

                </div>

                <div class="control-group col-xs-12 col-sm-6">

                    <div class="control-label">
                        <label for="Nivel">Nível</label>
                    </div>

                    <div class="controls">

                        <select class="form-control" id="Nivel" name="Nivel" required="required">
                            <option value="" <?= (Formulario::set_value("Nivel") == ""  ? 'selected="selected"' : "") ?>>Selecione o Nível</option>
                            <option value="1" <?= (Formulario::set_value("Nivel") == "1" ? 'selected="selected"' : "") ?>>Administrador</option>
                            <option value="2" <?= (Formulario::set_value("Nivel") == "2" ? 'selected="selected"' : "") ?>>Usuário</option>
                        </select>

                    </div>

                </div>

                <div class="control-group col-12 col-sm-6">

                    <div class="control-label">
                        <label for="NomeCompleto">Nome Completo</label>
                    </div>

                    <div class="controls">

                        <input type="text" class="form-control" id="NomeCompleto" name="NomeCompleto" placeholder="Informe Nome Completo" maxlength="100" required="required" value="<?= Formulario::set_value("NomeCompleto") ?>" />

                    </div>

                </div>

                <div class="control-group col-12 col-sm-6">

                    <div class="control-label">
                        <label for="Email">E-mail</label>
                    </div>

                    <div class="controls">

                        <input type="mail" class="form-control" id="Email" name="Email" placeholder="seuemail@dominio.com.br" maxlength="100" required="required" value="<?= Formulario::set_value("Email") ?>" />

                    </div>

                </div>

                <div class="control-group col-12 col-sm-6">

                    <div class="control-label">
                        <label for="Login">Login</label>
                    </div>

                    <div class="controls">

                        <input type="text" class="form-control" id="Login" name="Login" placeholder="Informe Login" maxlength="100" required="required" value="<?= Formulario::set_value("Login") ?>" />

                    </div>

                </div>

                <div class="control-group col-12 col-sm-6">

                    <div class="control-label">
                        <label for="Senha">Senha</label>
                    </div>

                    <div class="controls">

                        <input type="password" class="form-control" id="Senha" name="Senha" placeholder="Informe Senha" maxlength="100" />

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="control-group col-12">
                    &nbsp;
                </div>
            </div>

            <div class="row">
                <div class="control-group col-12">
                    <a href="<?= SITE_URL . "listaUsuario" ?>" class="btn btn-danger">Voltar</a>
                    <?php
                    if ($acao != "visualizar") {
                    ?>
                        <button name="btEnviar" id="btEnviar" class="btn btn-success" type="submit">Gravar</button>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </form>

    </div>
</section>