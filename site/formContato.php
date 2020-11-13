<?php
require_once "lib/Seguranca.php";

// Verifica se o usuário está logado para continuar

Seguranca::esta_logado(1);

//

require_once 'lib/Formulario.php';
require_once $pasta . '/modelContatos.php';

$model = new modelContatos();

$dados = $model->buscaCodContato($conDb, $id);

$descricao = Formulario::set_value("Descricao");

?>
<section class="Padrao">
    <div class="pTitle mb-5 container">

        <div class="row mb-3">

            <div class="col-10">

                <h3>Contato - <?= Formulario::form_sub_titulo($acao) ?><h3>

            </div>

            <div class="col-2" style="padding-top: 25px; text-align: right;">

                <a href="<?= SITE_URL . "listaContato" ?>" title="Lista de Contatos"><i class="fas fa-list"></i></a>

            </div>

        </div>
        <form action="<?= SITE_URL . "controllerContato/" . Formulario::formAcao($acao) ?>" method="POST" class="form" name="formContato" id="formContato" enctype="multipart/form-data">

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label for="codContato">Código</label>
                    <input type="number" readonly="readonly" class="form-control" name="codContato" id="codContato" value="<?= Formulario::set_value("codContato", 0) ?>">
                </div>
                <div class="form-group col-md-5">
                    <label for="nome">Nome</label>
                    <input type="text" required class="form-control" disabled name="Nome" id="Nome" value="<?= Formulario::set_value("Nome", "") ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="Email">Email</label>
                    <input required type="email" class="form-control" disabled name="Email" id="Email" value="<?= Formulario::set_value("Email", "") ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="StatusPedido">Status do Pedido</label>
                    <select required name="StatusPedido" id="StatusPedido" class="form-control">
                        <option <?= (Formulario::set_value("StatusPedido") == "1"  ? 'selected="selected"' : "") ?> value="1">Pendente</option>
                        <option <?= (Formulario::set_value("StatusPedido") == "2"  ? 'selected="selected"' : "") ?> value="2">Lido</option>
                        <option <?= (Formulario::set_value("StatusPedido") == "3"  ? 'selected="selected"' : "") ?> value="3">Concluído</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="TipoProjeto">Tipo do Pedido</label>
                    <select disabled required name="TipoProjeto" id="TipoProjeto" class="form-control">
                        <option disabled value="" <?= (Formulario::set_value("TipoProjeto") == ""  ? 'selected="selected"' : "") ?>>Selecione...</option>
                        <option <?= (Formulario::set_value("TipoProjeto") == "1"  ? 'selected="selected"' : "") ?> value="1">Parede Personalizada</option>
                        <option <?= (Formulario::set_value("TipoProjeto") == "2"  ? 'selected="selected"' : "") ?> value="2">Quadro Personalizado</option>
                        <option <?= (Formulario::set_value("TipoProjeto") == "3"  ? 'selected="selected"' : "") ?> value="3">Lettering Publicitário</option>
                        <option <?= (Formulario::set_value("TipoProjeto") == "4"  ? 'selected="selected"' : "") ?> value="4">Lettering Geral</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="Email">Data do Envio</label>
                    <input required type="text" class="form-control" disabled name="text" id="text" value="<?= Formulario::set_value("DataContato", "") ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="descricao">Descrição</label>
                    <textarea required name="Descricao" id="Descricao" disabled cols="30" rows="7" class="form-control">
                    <?= $descricao ?>
                </textarea>
                </div>
            </div>
            <h6 class="text-danger">Lembre-se de Marcar como Lido/Concluído!</h6>
            <a class="btn btn-danger" href="<?= SITE_URL ?>listaContato">Voltar</a>

            <button name="btEnviar" id="btEnviar" class="btn btn-success" type="submit">Gravar</button>

        </form>
    </div>
</section>