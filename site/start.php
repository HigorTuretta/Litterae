<?php

require_once "modelPortifolio.php";
require_once "modelSlides.php";

$model = new modelPortifolio();
$modelSlide = new modelSlides();
$dados = $model->buscaRecentes($conDb);
$slider = $modelSlide->buscaSlidesHabilitados($conDb);

?>
<!-- SLIDE BEGIN -->
<section class="Padrao ">
    <div class="carroca ">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner center-block">
                <?php
                if ($slider) {

                    foreach ($slider as $key => $value) {
                ?>
                        <div class="carousel-item  <?= $key === 0 ? "active" : "" ?>">
                            <img src="<?= SITE_URL . 'assets/images/slides/' . $value->Imagem ?>" class="d-block mx-auto " alt="...">
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>
    <!-- SLIDE END -->
    <div class="container">
        <!-- SOBRE BEGIN -->
        <div>
            <div class="row text-center">
                <div class="col-lg mb-4">
                    <p class="text-sobre"><img src="<?= SITE_URL . "assets/images/quemSou.png" ?>" alt=""></p>
                    <span class="text-left">Olá, meu nome é Sara. Sou artista de lettering,
                        fiz curso de pintura e hoje juntei minha experiência com a arte de desenhar letras.
                        Compartilho meu trabalho nesse blog, no universo do
                        <a href="https://www.instagram.com/litterae.arte/" target="blank">Instagram</a> e
                        <a href="https://www.facebook.com/litterae.arte" target="blank">Facebook</a>.</span>
                </div>
                <div class="col-lg mb-4">
                <p class="text-sobre"><img src="<?= SITE_URL . "assets/images/servicos.png" ?>" alt=""></p>
                    <ul class="list-unstyled">
                        <li>• Paredes Personalizadas</li>
                        <li>• Placas e Quadros personalizados</li>
                        <li>• Lettering para publicidade, eventos e estampas</li>
                    </ul>
                </div>
                <div class="col-lg mb-5">
                <p class="text-sobre"><img src="<?= SITE_URL . "assets/images/contatos.png" ?>" alt=""></p>
                    <span>Se quiser fazer um comentário, pergunta ou pedir um orçamento, <a href="#contato">entre em
                            contato.</a> Será um prazer te atender!</span>
                </div>
            </div>
        </div>

        <hr class="Linha">
    </div>
    <!-- SOBRE END -->

    <!-- cards -->
    <div class="portifolio-cards">
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
    </div>
    <div class="mb-5 btn-portifolio">
        <a href="<?= SITE_URL ?>portifolio">
            <div class="personalized-button-back">
                <div class="personalized-button-front">
                    <p class="button-text">Portifólio Completo</p>
                </div>
            </div>
        </a>
    </div>
    <hr class="Linha container">
    <!-- cards end -->

    <!-- CONTATO -->
    <div class="container" id="contato">
        <h2><img src="<?= SITE_URL . "assets/images/orcamento.png" ?>"></h2>
        <form action="<?= SITE_URL ?>controllerContato/Insert" enctype="multipart/form-data" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Nome">Nome:</label>
                    <input type="text" name="Nome" id="Nome" placeholder="Informe seu nome" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="Email">Email:</label>
                    <input type="email" name="Email" id="Email" placeholder="Informe seu email" class="form-control" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3 mr-4">
                    <label for="TipoProjeto">Tipo de Projeto:</label>
                    <select required name="TipoProjeto" id="TipoProjeto" class="form-control">
                        <option value="0" selected disabled>Selecione...</option>
                        <option value="1">Parede Personalizada</option>
                        <option value="2">Quadro Personalizado</option>
                        <option value="3">Lettering para Publicidade</option>
                        <option value="4">Lettering Geral</option>
                    </select>
                </div>
                <!-- <div class="form group col-md-3">
                        <label for="arquivo">Tem alguma imagem de ideia base?</label>
                        <input type="file" name="arquivo" id="arquivo" accept=".png , .jpeg, .jpg">
                    </div> -->
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Descricao">Descreva seu projeto:</label>
                    <textarea required name="Descricao" id="Descricao" cols="30" rows="7" class="form-control" placeholder="Tente Descrever ao máximo o que será necessário, e se possivel, as medidas do mesmo"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 btn-enviar">
                    <button type="submit">
                        <div class="personalized-button-back">
                            <div class="personalized-button-front">
                                <p class="button-text">Enviar</p>
                            </div>
                        </div>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- WPP LINK  -->
    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=5532999385459" target="blank"><i class="fab fa-whatsapp"></i></a>
    <!-- WPP LINK -->
    <!-- CONTATO END -->
</section>