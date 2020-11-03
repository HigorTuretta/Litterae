<?php
require_once "lib/Seguranca.php";
    
// Verifica se o usuário está logado para continuar

Seguranca::esta_logado( 1 );

//

require_once "modelSlides.php";

$model = new modelSlides();
$dados = $model->lista($conDb);

?>
<section class="Padrao">
    <div class="container pTitle pb-5 ">

        <?php
        if (isset($_SESSION["msgSucesso"])) {
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION["msgSucesso"] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["msgSucesso"]);
        }

        if (isset($_SESSION["msgError"])) {
        ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION["msgError"] ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php
            unset($_SESSION["msgError"]);
        }
        ?>

        <div class="row">

            <div class="col-7">

                <h3>Lista de Slides</h3>

            </div>

            <div class="col-4">
            </div>

            <div class="col-1">

                <a href="<?= SITE_URL . "formSlide/novo/0" ?>" title="Novo">
                    <i style="font-size: 20px; color: green; margin-top: 10px;" class="far fa-plus-square"></i>
                </a>

            </div>
            <div class="col-1 mt-3 mb-3">
                <a href="<?= SITE_URL ?>areaAdministrativa" class="btn btn-danger">Voltar</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <table border="1" class="table table-hover table-condensed" name="tbListaSlides" id="tbListaSlides">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 13%;">Código</th>
                            <th>Status</th>                         
                            <th style="width: 12%;">Opções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        if ($dados) {

                            foreach ($dados as $key => $value) {
                        ?>

                                <tr>
                                    <td><?= $value->codSlide ?></td>
                                    <td align="center"><?= $model->mostraStatus($value->StatusSlide) ?></td>                                                                
                                    <td align="center">
                                        <a class="mr-1" href="<?= SITE_URL . "formSlide/visualizar/" . $value->codSlide ?>" title="Visualizar"><i class="far fa-eye"> </i></a>
                                        <a href="<?= SITE_URL . "formSlide/alterar/" . $value->codSlide ?>" title="Alterar"><i class="far fa-edit"></i> </a>
                                        <a class="ml-1" href="<?= SITE_URL . "formSlide/excluir/" . $value->codSlide ?>" title="Excluir"><i class="far fa-trash-alt"> </i></a>
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