<?php

require_once $pasta . '/modelContatos.php';

$model = new modelContatos();

if ($acao == "Insert") {

    $data = array(
        $_POST['Nome'],
        $_POST['Email'],
        $_POST['TipoProjeto'],
        $_POST['Descricao']
    );

    $result = $model->insert($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Pedido incluído com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível incluir o pedido no banco de dados !";
    }
} else if ($acao == "Update") {

    $data = array(
        $_POST['StatusPedido'],
        $_POST["codContato"]

    );

    $result = $model->update($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Pedido alterado com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível alterar o pedido no banco de dados !";
    }
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>home";
    </script>
<?php
} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $id);

    if ($result) {
        $_SESSION["msgSucesso"] = "Pedido excluído com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível excluir o pedido no banco de dados !";
    }
} else if ($acao == "Read-Mark") {

    $data = array(
        $id
    );

    $result = $model->marcarLido($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Marcado como lido!";
    } else {
        $_SESSION["msgError"] = "Houve um problema ao marcar como lido!";
    }
} else if ($acao == "UnRead-Mark") {

    $data = array(
        $id
    );

    $result = $model->desmarcarLido($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Desmarcado como lido!";
    } else {
        $_SESSION["msgError"] = "Houve um problema ao desmarcar como lido!";
    }
} else if ($acao == "Completed") {

    $data = array(
        $id
    );

    $result = $model->marcarConcluido($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Marcado como concluído!";
    } else {
        $_SESSION["msgError"] = "Houve um problema ao marcar como concluído!";
    }
} else if ($acao == "UnCompleted") {

    $data = array(
        $id
    );

    $result = $model->desmarcarConcluido($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Desmarcado como concluído!";
    } else {
        $_SESSION["msgError"] = "Houve um problema ao desmarcar como concluído!";
    }
}
?>
<script language="JavaScript">
    window.location = "<?= SITE_URL ?>listaContato";
</script>
<?php
