<?php

require_once $pasta . '/modelSite.php';

$model = new modelPortifolio();

if ($acao != "Delete") {

    $arquivos = $_FILES;
    $dir = "assets/images/blog/";
    $ImgCapa = $arquivos['ImgCapa'];
    $Img1 = $arquivos['Img1'];
    $Img2 = $arquivos['Img2'];
    $Img3 = $arquivos['Img3'];
    $Img4 = $arquivos['Img4'];

    $nomeImgCapa = $ImgCapa['name'];
    $nomeImg1 = $Img1['name'];
    $nomeImg2 = $Img2['name'];
    $nomeImg3 = $Img3['name'];
    $nomeImg4 = $Img4['name'];

    $nomeTmpImgCapa = $ImgCapa['tmp_name'];
    $nomeTmpImg1 = $Img1['tmp_name'];
    $nomeTmpImg2 = $Img2['tmp_name'];
    $nomeTmpImg3 = $Img3['tmp_name'];
    $nomeTmpImg4 = $Img4['tmp_name'];
    $imagens = array($ImgCapa, $Img1, $Img2, $Img3, $Img4);

    // Lista de extensões permitidas
    $extensoesPermitidas = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

    // Tamanho máximo permitido em BYTES
    $tamanhoPermitido = 1024 * 1024 * 100; // 500kb

    $uploadCapa = false;
    $upload1 = false;
    $upload2 = false;
    $upload3 = false;
    $upload4 = false;

    if ((!empty($imagens))) {

        for ($i = 0; $i < count($imagens); $i++) {

            if ($imagens[$i]['error'] == 0) {

                if (array_search($imagens[$i]['type'], $extensoesPermitidas) === false) {
                    $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $imagens[$i]['name'] . ")";
                } else if ($imagens[$i]['size'] > $tamanhoPermitido) {

                    $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $imagens[$i]['name'] . ")";
                } else {

                    if ($i == 0) {
                        $uploadCapa = true;
                    } else if ($i == 1) {
                        $upload1 = true;
                    } else if ($i == 2) {
                        $upload2 = true;
                    } else if ($i == 3) {
                        $upload3 = true;
                    } else {
                        $upload4 = true;
                    }
                }
            }
        }
    }
}


if ($acao == "Insert") {

    if (($uploadCapa == true) && ($upload1 == true) && ($upload2 == true) && ($upload3 == true) && ($upload4 == true)) {


        $uploadCapa = move_uploaded_file($nomeTmpImgCapa, $dir . $nomeImgCapa);
        // Verfica se o arquivo foi movido com sucesso
        if (!$uploadCapa) {
            $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImgCapa . ")";
        }

        $upload1 = move_uploaded_file($nomeTmpImg1, $dir . $nomeImg1);
        // Verfica se o arquivo foi movido com sucesso
        if (!$upload1) {
            $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg1 . ")";
        }
        $upload2 = move_uploaded_file($nomeTmpImg2, $dir . $nomeImg2);
        // Verfica se o arquivo foi movido com sucesso
        if (!$upload2) {
            $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg2 . ")";
        }
        $upload3 = move_uploaded_file($nomeTmpImg3, $dir . $nomeImg3);
        // Verfica se o arquivo foi movido com sucesso
        if (!$upload3) {
            $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg3 . ")";
        }
        $upload4 = move_uploaded_file($nomeTmpImg4, $dir . $nomeImg4);
        // Verfica se o arquivo foi movido com sucesso
        if (!$upload4) {
            $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg4 . ")";
        }

        $data = array(
            $_POST['categoria'],
            $_POST["titulo"],
            $_POST["subTitulo"],
            $_POST["descricao"],
            $nomeImgCapa,
            $nomeImg1,
            $nomeImg2,
            $nomeImg3,
            $nomeImg4
        );

        $result = $model->insert($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Postagem incluída com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível incluir a postagem no banco de dados !";
        }
    }
} else if ($acao == "Update") {

    $CodPublicacao = $model->buscaCodPostagem($conDb, $_POST['CodPublicacao']);

    // Verifica se alguma imagem foi carregada, caso não, recebe o valor que já consta no BD, dessa forma na opção de Update 
    // os campos de imagem deixam de ser obrigatórios, ou seja, o usuário altera somente o campo de seu interesse 
    if ($nomeImgCapa == "") {
        $uploadCapa = true;
        $nomeImgCapa = trim($CodPublicacao['ImgCapa']);
    }

    if ($nomeImg1 == "") {
        $upload1 = true;
        $nomeImg1 = trim($CodPublicacao['Img1']);
    }

    if ($nomeImg2 == "") {
        $upload2 = true;
        $nomeImg2 = trim($CodPublicacao['Img2']);
    }

    if ($nomeImg3 == "") {
        $upload3 = true;
        $nomeImg3 = trim($CodPublicacao['Img3']);
    }

    if ($nomeImg4 == "") {
        $upload4 = true;
        $nomeImg4 = trim($CodPublicacao['Img4']);
    }

    // Verifica se os arquivos foram validaddos em questao de extensão e tamanho, caso não, isso evita que os dados sejam 
    // gravados no BD e imagens sejam movidas para a pasta uploads sem necessidade
    if (($uploadCapa == true) && ($upload1 == true) && ($upload2 == true) && ($upload3 == true) && ($upload4 == true)) {

        if ((trim($CodPublicacao['ImgCapa']) != ($nomeImgCapa))) {

            $uploadCapa = move_uploaded_file($nomeTmpImgCapa, $dir . $nomeImgCapa);
            if (!$uploadCapa) {
                $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImgCapa . ")";
            } else {

                unlink($dir . trim($CodPublicacao['ImgCapa']));
            }
        }

        if ((trim($CodPublicacao['Img1']) != ($nomeImg1))) {


            $upload1 = move_uploaded_file($nomeTmpImg1, $dir . $nomeImg1);
            if (!$upload1) {
                $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg1 . ")";
            } else {

                unlink($dir . trim($CodPublicacao['Img1']));
            }
        }

        if ((trim($CodPublicacao['Img2']) != ($nomeImg2))) {

            $upload2 = move_uploaded_file($nomeTmpImg2, $dir . $nomeImg2);
            if (!$upload2) {
                $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg2 . ")";
            } else {

                unlink($dir . trim($CodPublicacao['Img2']));
            }
        }

        if ((trim($CodPublicacao['Img3']) != ($nomeImg3))) {

            $upload3 = move_uploaded_file($nomeTmpImg3, $dir . $nomeImg3);
            if (!$upload3) {
                $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg3 . ")";
            } else {

                unlink($dir . trim($CodPublicacao['Img3']));
            }
        }

        if ((trim($CodPublicacao['Img4']) != ($nomeImg4))) {

            $upload4 = move_uploaded_file($nomeTmpImg4, $dir . $nomeImg4);
            if (!$upload4) {
                $_SESSION["msgError"] = "Falha ao realizar o upload da imagem! (" . $nomeImg4 . ")";
            } else {

                unlink($dir . trim($CodPublicacao['Img4']));
            }
        }


        $data = array(
            $_POST['categoria'],
            $_POST["titulo"],
            $_POST["subTitulo"],
            $_POST["descricao"],
            $nomeImgCapa,
            $nomeImg1,
            $nomeImg2,
            $nomeImg3,
            $nomeImg4,
            $_POST["CodPublicacao"]

        );


        $result = $model->update($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Postagem alterada com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível alterar a postagem no banco de dados !";
        }
    }
} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $_POST['CodPublicacao']);

    if ($result) {
        $_SESSION["msgSucesso"] = "Postagem excluída com sucesso !";

        //exclui as imagens no servidor
        unlink("assets/images/blog/" . trim($_POST["ExcluirCapa"]));
        unlink("assets/images/blog/" . trim($_POST["ExcluirImg1"]));
        unlink("assets/images/blog/" . trim($_POST["ExcluirImg2"]));
        unlink("assets/images/blog/" . trim($_POST["ExcluirImg3"]));
        unlink("assets/images/blog/" . trim($_POST["ExcluirImg4"]));
    } else {
        $_SESSION["msgError"] = "Não foi possível excluir a postagem no banco de dados !";
    }
}

?>
<script language="JavaScript">
    window.location = "<?= SITE_URL ?>listaPortifolio";
</script>
<?php
