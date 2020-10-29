<?php

require_once $pasta . '/modelPortifolio.php';

$model = new modelPortifolio();


if ($acao == "Insert") {

    if (trim($arUser['ImgCapa']) != $_FILES['imgCapa']['name'] and $_FILES['imgCapa']['name'] != "") {
        //pasta para onde o arquivo será movido no webSite
        $pasta = 'assets/images/blog/';

        //lista de tipos de arquivos permitidos
        $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        //tamanho máximo (em bytes)
        $tamanhoPermitido = 1024 * 500; //500kb

        //nome original do arquivo no computador do usuario
        $ImgCapa = $_FILES['imgCapa']['name'];

        //o tipo do arquivo
        $ImgCapaType = $_FILES['imgCapa']['type'];

        //o tamanho do arquivo
        $imgCapaSize = $_FILES['imgCapa']['size'];

        // o nome temporario do arquivo
        $ImgCapaTemp = $_FILES['imgCapa']['tmp_name'];

        //codigos de possiveis erros na imagem
        $imgCapaError = $_FILES['imgCapa']['error'];

        $uploadCapa = false;

        if ($imgCapaError === 0) {



            //veririca o tipo de arquivo enviado
            if (array_search($ImgCapaType, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $ImgCapa . ")";
            } else if ($imgCapaSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $ImgCapa . ")";
            } else { // não houve error, move o arquivo
                $uploadCapa = move_uploaded_file($ImgCapaTemp, $pasta . $ImgCapa);

                if (!$uploadCapa) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $ImgCapa . ")";
                }
            }
        }
    }

    //Procedimendo de upload para a segunda imagem
    if (trim($arUser['Img1']) != $_FILES['img01']['name']  and $_FILES['img01']['name'] != "") {


        $pasta = 'assets/images/blog/';


        $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        $tamanhoPermitido = 1024 * 500; //500kb

        $Img1 = $_FILES['img01']['name'];

        $Img1Type = $_FILES['img01']['type'];

        $Img1Size = $_FILES['img01']['size'];

        $Img1Temp = $_FILES['img01']['tmp_name'];

        $Img1Error = $_FILES['img01']['error'];

        $uploadImg1 = false;

        if ($Img1Error === 0) {



            if (array_search($Img1Type, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $Img1 . ")";
            } else if ($Img1Size > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $Img1 . ")";
            } else { // não houve error, move o arquivo
                $uploadImg1 = move_uploaded_file($Img1Temp, $pasta . $Img1);

                if (!$uploadImg1) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $Img1 . ")";
                }
            }
        }
    }

    //confere se algumas das imagens não foram enviadas // se não foi apaga qualquer imagem que foi validada
    if (!$uploadCapa) {
        unlink("assets/images/blog/" . $Img1);
        //Retorna o erro reforçando a obrigatoriedade dos campos
        $_SESSION["msgError"] = "A Imagem de Capa e/ou Imagem 01 não foram selecionadas!";
    }

    if (!$uploadImg1) {
        unlink("assets/images/blog/" . $ImgCapa);
        //Retorna o erro reforçando a obrigatoriedade dos campos
        $_SESSION["msgError"] = "A Imagem de Capa e/ou Imagem 01 não foram selecionadas!";
    }

    if ($uploadCapa and $uploadImg1) {

        $data = array(
            $_POST['categoria'],
            $_POST["titulo"],
            $_POST["subTitulo"],
            $_POST["descricao"],
            $ImgCapa,
            $Img1
        );

        $result = $model->insert($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Categoria incluída com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível incluir a categoria no banco de dados !";
        }
    }
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaPortifolio";
    </script>
<?php

} else if ($acao == "Update") {

    $arUser = $model->buscaCodPostagem($conDb, $_POST["CodPublicacao"]);
    $ImgCapa = trim($arUser['ImgCapa']);
    $Img1 = trim($arUser['Img1']);
    $uploadCapa = true;
    $uploadImg1 = true;

    if (trim($arUser['ImgCapa']) != $_FILES['imgCapa']['name'] and $_FILES['imgCapa']['name'] != "") {

        //pasta para onde o arquivo será movido no webSite
        $pasta = 'assets/images/blog/';

        //lista de tipos de arquivos permitidos
        $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        //tamanho máximo (em bytes)
        $tamanhoPermitido = 1024 * 500; //500kb

        //nome original do arquivo no computador do usuario
        $ImgCapa = $_FILES['imgCapa']['name'];

        //o tipo do arquivo
        $ImgCapaType = $_FILES['imgCapa']['type'];

        //o tamanho do arquivo
        $imgCapaSize = $_FILES['imgCapa']['size'];

        // o nome temporario do arquivo
        $ImgCapaTemp = $_FILES['imgCapa']['tmp_name'];

        //codigos de possiveis erros na imagem
        $imgCapaError = $_FILES['imgCapa']['error'];

        if ($imgCapaError === 0) {

            $uploadCapa = false;

            //veririca o tipo de arquivo enviado
            if (array_search($ImgCapaType, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $ImgCapa . ")";
            } else if ($imgCapaSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $ImgCapa . ")";
            } else { // não houve error, move o arquivo
                $uploadCapa = move_uploaded_file($ImgCapaTemp, $pasta . $ImgCapa);

                if (!$uploadCapa) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $ImgCapa . ")";
                } else {
                    unlink('assets/images/blog/' . trim($arUser['ImgCapa']));
                }
            }
        }
    }


    if (trim($arUser['Img1']) != $_FILES['img01']['name']  and $_FILES['img01']['name'] != "") {


        $pasta = 'assets/images/blog/';


        $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

        $tamanhoPermitido = 1024 * 500; //500kb

        $Img1 = $_FILES['img01']['name'];

        $Img1Type = $_FILES['img01']['type'];

        $Img1Size = $_FILES['img01']['size'];

        $Img1Temp = $_FILES['img01']['tmp_name'];

        $Img1Error = $_FILES['img01']['error'];
        if ($Img1Error === 0) {

            $uploadImg1 = false;

            if (array_search($Img1Type, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $Img1 . ")";
            } else if ($Img1Size > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $Img1 . ")";
            } else { // não houve error, move o arquivo
                $uploadImg1 = move_uploaded_file($Img1Temp, $pasta . $Img1);

                if (!$uploadImg1) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $Img1 . ")";
                } else {
                    unlink('assets/images/blog/' . trim($arUser['Img1']));
                }
            }
        }
    }


    if ($uploadCapa and $uploadImg1) {


        $data = array(
            $_POST['categoria'],
            $_POST["titulo"],
            $_POST["subTitulo"],
            $_POST["descricao"],
            $ImgCapa,
            $Img1,
            $_POST["CodPublicacao"]

        );


        $result = $model->update($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Postagem alterada com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível alterar a postagem no banco de dados !";
        }
    }
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaPortifolio";
    </script>
<?php

} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $_POST['CodPublicacao']);

    if ($result) {
        $_SESSION["msgSucesso"] = "Categoria excluída com sucesso !";

        //exclui as imagens no servidor
        unlink("assets/images/blog/" . trim($_POST["ExcluirCapa"]));
        unlink("assets/images/blog/" . trim($_POST["ExcluirImg1"]));
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
