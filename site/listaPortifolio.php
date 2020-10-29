<?php

require_once "modelPortifolio.php";
    
$model = new modelPortifolio();
$dados = $model->lista($conDb);

?>

<div class="container pTitle mb-5">    

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

            <h3>Lista de Postagens</h3>

        </div>
        
        <div class="col-4">
        </div>
              
        <div class="col-1">
            
            <a href="<?= SITE_URL . "formPortifolio/novo/0" ?>" title="Novo">
            <i class="far fa-plus-square"></i>
            </a>

        </div>

    </div>
   
    <div class="row">

        <div class="col-12">

            <table border="1" class="table table-hover table-condensed" name="tbListaUsuario" id="tbListaUsuario">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 13%;">Status</th>
                        <th style="width: 8%;">Código</th>
                        <th>Título</th>
                        <th>Sub-Título</th>
                        <th style="width: 20%;">Data da postagem</th>
                        <th style="width: 12%;">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
                    
                    if ( $dados ) {
                    
                        foreach ($dados as $key => $value) {
                            ?>
                    
                            <tr>
                                <td align="center"><?= $model->mostraStatus( $value->StatusPostagem ) ?></td>
                                <td align="center"><?= $value->codPublicacao ?></td>
                                <td><?= $value->Titulo ?></td>
                                <td><?= $value->SubTitulo ?></td>
                                <td><?= $value->dataPostagem?></td>                              
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
