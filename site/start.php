<?php

require_once "modelSite.php";

$model = new modelPortifolio();
$modelSlide = new modelSlides();
$dados = $model->buscaRecentes($conDb);
$slider = $modelSlide->buscaSlidesHabilitados($conDb);

?>
<!-- SLIDE BEGIN -->
<section class="Padrao ">
    <div class="slider-area">
        <div class="img-slider">
            <?php
            if ($slider) {

                foreach ($slider as $key => $value) {
            ?>
                    <div class="slide  <?= $key === 0 ? "active" : "" ?>">
                        <img src="<?= SITE_URL . 'assets/images/slides/' . $value->Imagem ?>" class="d-block mx-auto " alt="...">
                    </div>
            <?php
                }
            }
            ?>
            <div class="navigation">

                <?php
                if ($slider) {

                    foreach ($slider as $key => $value) {
                ?>
                        <div class="navigation-button <?= $key === 0 ? "active" : "" ?>"></div>
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
                    <p class="text-sobre">Quem sou?</p>
                    <span class="text-left">Olá, meu nome é Sara. Sou artista de lettering,
                        fiz curso de pintura e hoje juntei minha experiência com a arte de desenhar letras.
                        Compartilho meu trabalho nesse blog, no universo do
                        <a href="https://www.instagram.com/litterae.arte/" target="blank">Instagram</a> e
                        <a href="https://www.facebook.com/litterae.arte" target="blank">Facebook</a>.</span>
                </div>
                <div class="col-lg mb-4">
                    <p class="text-sobre">Serviços</p>
                    <ul class="list-unstyled">
                        <li>• Paredes Personalizadas</li>
                        <li>• Placas e Quadros personalizados</li>
                        <li>• Lettering para publicidade, eventos e estampas</li>
                    </ul>
                </div>
                <div class="col-lg mb-5">
                    <p class="text-sobre">Contatos</p>
                    <span>Se quiser fazer um comentário, pergunta ou pedir um orçamento, <a href="<?= SITE_URL ?>contato">entre em
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
            <div class="pTitle-home mb-4">
                <h2 class="text-center">Alguns dos meus Trabalhos</h2>
            </div>
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
                            <img class="img-fluid" src="assets/images/blog/<?= $value->ImgCapa ?>" alt="<?= $value->ImgCapa ?>">
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
    <div class="btn-portifolio">
        <a href="<?= SITE_URL ?>portifolio">
            <div class="personalized-button-back">
                <div class="personalized-button-front">
                    <p class="button-text">Portifólio Completo</p>
                </div>
            </div>
        </a>
    </div>
    <!-- cards end -->

    <!-- WPP LINK  -->
    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=5532999385459" target="blank"><i class="fab fa-whatsapp"></i></a>
    <!-- WPP LINK -->
    <!-- CONTATO END -->
</section>

<script>
    // JAVASCRIPT PARA O FUNCIONAMENTO DO SLIDER CLICANDO
    $(window).on("load", function() {
        var slides = document.querySelectorAll('.slide');
        var btns = document.querySelectorAll('.navigation-button');

        let currentslide = 1;

        var manualNav = function(manual) {

            slides.forEach((slide) => {
                slide.classList.remove('active');

                btns.forEach((btn) => {
                    btn.classList.remove('active');
                });
            });

            slides[manual].classList.add('active');
            btns[manual].classList.add('active');
        }

        btns.forEach((btn, i) => {
            btn.addEventListener('click', () => {
                manualNav(i);
                currentslide = i;
            })
        })

        // JAVASCRIPT PARA O FUNCIONAMENTO DO SLIDER AUTOMATICAMENTE
        var repeat = function(activeClass) {
            let active = document.getElementsByClassName('active');
            let i = 1;

            var repeater = () => {
                setTimeout(() => {
                    [...active].forEach((activeSlide) => {
                        activeSlide.classList.remove('active');
                    });

                    slides[i].classList.add('active');
                    btns[i].classList.add('active');
                    i++;

                    if (slides.length == i) {
                        i = 0
                    }

                    if (i >= slides.length) {
                        return;
                    }
                    repeater();
                }, 5000);
            }
            repeater();
        }
        repeat();
    });
</script>