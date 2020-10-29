<?php

require_once $pasta . '/modelPortifolio.php';

$model = new modelPortifolio();


if ($acao == "Insert") {


    //pasta para onde o arquivo será movido no web site
    $pastaBlog = 'assets/images/blog/';

    if (isset($_FILES['img01'])) {
        $Img1 = $_FILES['img01']['name'];
        $extensao = strtolower(substr($_FILES['img01']['name'], -4));
        $dir = $pastaBlog;
        move_uploaded_file($_FILES['img01']['tmp_name'], $dir . $Img1);
    }

    if (isset($_FILES['img02'])) {
        $Img2 = $_FILES['img02']['name'];
        $extensao = strtolower(substr($_FILES['img02']['name'], -4));
        $dir = $pastaBlog;
        move_uploaded_file($_FILES['img02']['tmp_name'], $dir . $Img2);
    }


    $data = array(
        $_POST['categoria'],
        $_POST["titulo"],
        $_POST["subTitulo"],
        $_POST["descricao"],
        $Img1,
        $Img2
    );

    $result = $model->insert($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria incluída com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível incluir a categoria no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaPortifolio";
    </script>
<?php

} else if ($acao == "Update") {

    $arUser = $model->buscaCodPostagem($conDb, $_POST['codPublicacao']);
    $imgCapa = trim($arUser['ImgCapa']);
    $imagem01 = trim($arUser['Img1']);
    $pastaBlog = 'assets/images/blog/';

    if (isset($_FILES["Img01"])) {
        if ($imgCapa != $_FILES["Img01"]["name"]) {

            //pasta para onde o arquivo será movido no web site
            if (isset($_FILES['img01'])) {
                $Img1 = $_FILES['img01']['name'];
                $extensao = strtolower(substr($_FILES['img01']['name'], -4));
                $dir = $pastaBlog;
                move_uploaded_file($_FILES['img01']['tmp_name'], $dir . $Img1);
                unlink('assets/images/blog/' . $imgCapa);
            }
        }
    }
    if (isset($_FILES["Img02"])) {
        if ($imagem01 != $_FILES["Img02"]["name"]) {

            if (isset($_FILES['img02'])) {
                $Img2 = $_FILES['img02']['name'];
                $extensao = strtolower(substr($_FILES['img02']['name'], -4));
                $dir = $pastaBlog;
                move_uploaded_file($_FILES['img02']['tmp_name'], $dir . $Img2);
                unlink('assets/images/blog/' . $imagem01);
            }
        }
    }

    $data = array(
        $_POST['categoria'],
        $_POST["titulo"],
        $_POST["subTitulo"],
        $_POST["descricao"],
        $Img1,
        $Img2,
        $_POST["codPublicacao"]

    );

    $result = $model->update($conDb, $data);

    if ($result) {
        $_SESSION["msgSucesso"] = "Postagem alterada com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível alterar a postagem no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaPortifolio";
    </script>
<?php

} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $_POST['codPublicacao']);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria excluída com sucesso !";
    } else {
        $_SESSION["msgError"] = "Não foi possível excluir a categoria no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaPortifolio";
    </script>
<?php

}

?>
<script language="JavaScript">
    window.location = "<?= SITE_URL ?>";
</script>
<?php
