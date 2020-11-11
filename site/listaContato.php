<?php
require_once "lib/Seguranca.php";
require_once "lib/Formulario.php";
// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once "modelContatos.php";

$model = new modelContatos();
$dados = $model->lista($conDb);

?>
<section class="Padrao">
    <div class="container pTitle pb-5 ">

    <?= Formulario::exibeMensagem()?>

        <div class="row">

            <div class="col-7">

                <h3>Lista de Contatos</h3>

            </div>

            <div class="col-4">
            </div>

            <div class="col-1 mt-3 mb-3">
                <a href="<?= SITE_URL ?>areaAdministrativa" class="btn btn-danger">Voltar</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <table border="1" class="table table-hover table-condensed" name="tblListaContato" id="tblListaContato">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Tipo Projeto</th>
                            <th>Status</th>
                            <th style="width: 12%;">Opções</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        if ($dados) {

                            foreach ($dados as $key => $value) {
                        ?>

                                <tr class="<?= $value->StatusPedido == 1 ? "font-weight-bold" : "" ?> ">
                                    <td><?= $value->Nome ?><?= $value->StatusPedido == 3 ? '<span class="ml-2 badge badge-success">Concluído</span>' : "" ?></td>
                                    <td align="center"><?= $model->mostraTipoProjeto($value->TipoProjeto) ?></td>
                                    <td align="center"><?= $model->mostraStatusPedido($value->StatusPedido) ?></td>
                                    <td align="center">
                                        <?php
                                        if ($value->StatusPedido == 1) {
                                        ?>
                                            <a class="mr-1" href="<?= SITE_URL . "controllerContato/Read-Mark/" . $value->codContato ?>" title="Marcar como Lido"><i class="far fa-bookmark"></i> </a>
                                        <?php
                                        } else if ($value->StatusPedido == 2) {
                                        ?>
                                            <a class="mr-1" href="<?= SITE_URL . "controllerContato/UnRead-Mark/" . $value->codContato ?>" title="Desmarcar como Lido"><i class="fas fa-bookmark"></i> </a>
                                            <a class="mr-1" href="<?= SITE_URL . "controllerContato/Completed/" . $value->codContato ?>" title="Marcar como concluído"><i class="far fa-calendar-check"></i> </a>

                                        <?php
                                        } else {
                                        ?>
                                            <a class="mr-1" href="<?= SITE_URL . "controllerContato/UnCompleted/" . $value->codContato ?>" title="Desmarcar como concluído"><i class="fas fa-calendar-check"></i> </a>

                                        <?php
                                        }
                                        ?>
                                        <a href="<?= SITE_URL . "formContato/alterar/" . $value->codContato ?>" title="Visualizar/Alterar"><i class="far fa-edit"></i> </a>
                                        <a class="ml-1" onclick="return confirm('Tem certeza que deseja excluir o registro?')" href="<?= SITE_URL . "controllerContato/Delete/" . $value->codContato ?>" title="Excluir"><i class="far fa-trash-alt"> </i></a>
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
<?= Formulario::setDataTable("tblListaContato") ?>