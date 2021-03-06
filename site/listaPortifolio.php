<?php
require_once "lib/Seguranca.php";
require_once "lib/Formulario.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once "modelSite.php";

$model = new modelPortifolio();
$dados = $model->lista($conDb);

?>
<section class="Padrao">
    <div class="container pTitle pb-5 ">

        <?= Formulario::exibeMensagem() ?>

        <div class="row">

            <div class="col-7">

                <h3>Lista de Postagens</h3>

            </div>

            <div class="col-4">
            </div>

            <div class="col-1">

                <a href="<?= SITE_URL . "formPortifolio/novo/0" ?>" title="Novo">
                    <i style="font-size: 20px; color: green; margin-top: 10px;" class="far fa-plus-square"></i>
                </a>

            </div>
            <div class="col-1 mt-3 mb-3">
                <a href="<?= SITE_URL ?>areaAdministrativa" class="btn btn-danger">Voltar</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <table border="1" class="table table-hover table-condensed" name="tblListaPortifolio" id="tblListaPortifolio">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 13%;">Status</th>
                            <th>Título</th>
                            <th>Sub-Título</th>
                            <th style="width: 20%;">Data da postagem</th>
                            <th style="width: 12%;">Opções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        if ($dados) {

                            foreach ($dados as $key => $value) {
                        ?>

                                <tr>
                                    <td align="center"><?= $model->mostraStatus($value->StatusPostagem) ?></td>
                                    <td><?= $value->Titulo ?></td>
                                    <td><?= $value->SubTitulo ?></td>
                                    <td><?= $value->dataPostagem ?></td>
                                    <td align="center">
                                        <a class="mr-1" href="<?= SITE_URL . "formPortifolio/visualizar/" . $value->codPublicacao ?>" title="Visualizar"><i class="far fa-eye"> </i></a>
                                        <a href="<?= SITE_URL . "formPortifolio/alterar/" . $value->codPublicacao ?>" title="Alterar"><i class="far fa-edit"></i> </a>
                                        <a class="ml-1" href="<?= SITE_URL . "formPortifolio/excluir/" . $value->codPublicacao ?>" title="Excluir"><i class="far fa-trash-alt"> </i></a>
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


<?= Formulario::setDataTable("tblListaPortifolio") ?>