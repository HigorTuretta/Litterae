<?php

require_once $pasta . '/modelCategorias.php';

$model = new modelCategorias();
$arUser = $model->buscaCodCategoria($conDb, $_POST["codCategoria"]);

if ($acao == "Insert") {

    $data = array(
        $_POST['descricao'],
        $_POST['statusCategoria']
    );

    $result = $model->insert($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria incluída com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível incluir a Categoria no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaCategoria";
    </script>
<?php

} else if ($acao == "Update") {

    $data = array(
        $_POST["descricao"],
        $_POST["statusCategoria"],
        $_POST["codCategoria"]

    );

    $result = $model->update($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria alterada com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível alterar a categoria no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaCategoria";
    </script>
<?php

} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $_POST['codCategoria']);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria excluída com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível excluir a categoria no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaCategoria";
    </script>
<?php

}

?>
<script language="JavaScript">
    window.location = "<?= SITE_URL ?> listaCategoria";
</script>
<?php
