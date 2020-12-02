<?php
require_once 'lib/Formulario.php';
?>

<section class="Padrao">
    <div class="container" id="contato">
        <h2>Faça seu Orçamento!</h2>
        <p>Para solicitar um orçamento ou marcar uma visita, é só preencher o formulário abaixo ou, se preferir, me mandar um e-mail: contatolitterae.arte@gmail.com.
            Você também pode clicar no ícone do <a href="https://api.whatsapp.com/send?phone=5532999385459">WhatsApp</a> em sua tela para iniciar uma conversa diretamente conosco! Fique a vontade!</p>
        <small class="text-center">
            Não se esqueça de me acompanhar nas redes sociais, para ficar por dentro de todas as novidades e promoções!
        </small>
        <div class="text-left contato-links">
            <a href="https://www.instagram.com/litterae.arte/" target="blank"><i class="fab fa-instagram-square"></i></a>
            <a href="https://www.facebook.com/litterae.arte" target="blank"><i class="fab fa-facebook-square"></i></a>
        </div>
        <hr>
        <div>
            <?= Formulario::exibeMensagem() ?>
        </div>
        <form action="<?= SITE_URL ?>faleConoscoEnvio" enctype="multipart/form-data" method="POST">
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
                <div class="metricas">
                    <div class="form-group mr-4">
                        <label for="Altura">Altura:</label>
                        <input  class="form-control" type="number" step="0.01" name="Altura" id="Altura">
                    </div>                

                </div>
                <div class="metricas">
                    <div class="form-group">
                        <label for="Largura">Largura:</label>
                        <input  class="form-control" type="number" step="0.01" name="Largura" id="Largura">
                    </div>
                </div>
                <div class="form group col-md-3 ml-4">
                    <label for="arquivo">Tem alguma imagem de ideia base?</label>
                    <input type="file" multiple name="arquivo[]" id="arquivo[]" accept=".png , .jpeg , .jpg , .mp4">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Descricao">Descreva seu projeto:</label>
                    <textarea required name="Descricao" id="Descricao" cols="30" rows="7" class="form-control" placeholder="Tente Descrever ao máximo qual é a sua idéia, frases ou textos que prefere,caso seja parede informações sobre o acabamento da mesma, envie de preferência algumas fotos,  e se possivel, as medidas do mesmo. Isso torna o procedimento mais rápido para melhor te atender!"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div data-netlify-recaptcha="true"></div>
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
        <!-- WPP LINK  -->
        <a class="whatsapp" href="https://api.whatsapp.com/send?phone=5532999385459" target="blank"><i class="fab fa-whatsapp"></i></a>
        <!-- WPP LINK -->
    </div>
</section>


<!-- SCRIPT DE CONTROLE DE CAMPOS DO FORMULÁRIO -->
<script>
    $(document).ready(function() {
        $('.metricas').hide();
        $('#TipoProjeto').change(function() {
            if ($('#TipoProjeto').val() == '1') {
                $('.metricas').show();
                $('#Altura').attr('required' , true);
                $('#Largura').attr('required', true);
            } else {
                $('.metricas').hide();
                $('#Altura').removeAttr('required');
                $('#Largura').removeAttr('required');
            }
        });
    });
</script>