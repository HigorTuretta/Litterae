<?php

require_once "lib/Seguranca.php";
require_once "lib/Formulario.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once "modelUsuario.php";

$model = new modelUsuario();
$dados = $model->lista($conDb);

?>
<section class="Padrao">
    <div class="container">

        <?= Formulario::exibeMensagem() ?>

        <div class="row">

            <div class="col-7">

                <h3>Lista de Usuários</h3>

            </div>

            <div class="col-4">
            </div>

            <div class="col-1">
                <a href="<?= SITE_URL . "formUsuario/novo/0" ?>" title="Novo">
                    <i style="font-size: 20px; color: green; margin-top: 10px;" class="far fa-plus-square"></i>
                </a>
            </div>
            <div class="col-1 mt-3 mb-3">
                <a href="<?= SITE_URL ?>areaAdministrativa" class="btn btn-danger">Voltar</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <table border="1" class="table table-hover table-condensed" name="tbListaUsuario" id="tbListaUsuario">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 10%;">Status</th>
                            <th>Login</th>
                            <th>Nome</th>
                            <th style="width: 12%;">Nível</th>
                            <th style="width: 10%;">Opções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        if ($dados) {

                            foreach ($dados as $key => $value) {
                        ?>

                                <tr>
                                    <td align="center"><?= $model->mostraStatus($value->StatusCadastro) ?></td>
                                    <td><?= $value->Login ?></td>
                                    <td><?= $value->NomeCompleto ?></td>
                                    <td><?= $model->mostraNivel($value->Nivel) ?></td>
                                    <td>
                                        <a class="mr-1" href="<?= SITE_URL . "formUsuario/visualizar/" . $value->CodUsuario ?>" title="Visualizar"><i class="far fa-eye"> </i></a>
                                        <a href="<?= SITE_URL . "formUsuario/alterar/" . $value->CodUsuario ?>" title="Alterar"><i class="far fa-edit"></i></a>
                                        <a class="ml-1" href="<?= SITE_URL . "formUsuario/excluir/" . $value->CodUsuario ?>" title="Excluir"><i class="far fa-trash-alt"> </i></a>
                                    </td>
                                </tr>

                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7">Nenhum registro localizado...</td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</section>

<?= Formulario::setDataTable("tbListaUsuario") ?>