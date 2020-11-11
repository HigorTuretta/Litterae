<?php

require_once "modelSite.php";

$model = new modelPortifolio();
$dados = $model->listaHabilitados($conDb);

?>
<section class="Padrao">

    <div class="pTitle">
        <h2 class="text-center">Portifólio Completo</h2>
    </div>

    <section class="portifolio-cards">
        <div class="container-personalized">

            <?php
            if ($dados) {

                foreach ($dados as $key => $value) {
                    if ($key % 3 === 0 or $key === 0) {
            ?>
                        <div class="row-personalized">

                        <?php
                    }
                        ?>

                        <div class="image">
                            <img src="assets/images/blog/<?= $value->ImgCapa ?>" alt="<?= $value->ImgCapa ?>">
                            <div class="details">
                                <h2><?= $value->Titulo ?></h2>
                                <p><?= $value->SubTitulo ?></p>

                                <div class="more">
                                    <a href="<?= SITE_URL . "saibaMais/visualizar/" . $value->codPublicacao ?>" class="read-more"> Saiba <span>Mais</span></a>
                                </div>
                            </div>
                        </div>


                    <?php

                }
            } else {

                    ?>
                    <div>
                        <h2>Sem projetos ainda... :(</h2>
                    </div>
                <?php
            }
                ?>
                        </div>
        </div>
    </section>
    <!-- WPP LINK  -->
    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=5532999385459" target="blank"><i class="fab fa-whatsapp"></i></a>
    <!-- WPP LINK -->
</section>