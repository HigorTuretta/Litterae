<?php

require_once $pasta . '/modelSlides.php';

$model = new modelSlides();
$arUser = $model->buscaCodSlides($conDb, $_POST["codSlide"]);

//pasta para onde o arquivo será movido no webSite
$pasta = 'assets/images/slides/';

//lista de tipos de arquivos permitidos
 $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

  //tamanho máximo (em bytes)
  $tamanhoPermitido = 1024*1024*100; //5mb

  //nome original do arquivo no computador do usuario
  $Imagem = $_FILES['Imagem']['name'];

  //o tipo do arquivo
  $ImagemType = $_FILES['Imagem']['type'];

  //o tamanho do arquivo
  $ImagemSize = $_FILES['Imagem']['size'];

  // o nome temporario do arquivo
  $ImagemTemp = $_FILES['Imagem']['tmp_name'];

  //codigos de possiveis erros na imagem
  $ImagemError = $_FILES['Imagem']['error'];


if ($acao == "Insert") {
    
    if (trim($arUser['Imagem']) != $_FILES['Imagem']['name'] and $_FILES['Imagem']['name'] != "") {      

        $upload = false;

        if ($ImagemError === 0) {
            //veririca o tipo de arquivo enviado
            if (array_search($ImagemType, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $Imagem . ")";
            } else if ($ImagemSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $Imagem . ")";
            } else { // não houve error, move o arquivo
                $upload = move_uploaded_file($ImagemTemp, $pasta . $Imagem);

                if (!$upload) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $Imagem . ")";
                }
            }
        }
    }  

    if ($upload) {

        $data = array(           
            $Imagem,
            $_POST['StatusSlide']
        );

        $result = $model->insert($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Slide incluído com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível incluir o Slide no banco de dados !";
        }
    }
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaSlides";
    </script>
<?php

} else if ($acao == "Update") {

    $Imagem = trim($arUser['Imagem']); 
    $upload = true;

    //procedimendo para a imagem de Capa
    if (trim($arUser['Imagem']) != $_FILES['Imagem']['name'] and $_FILES['Imagem']['name'] != "") {        

       //lista de tipos de arquivos permitidos
       $tiposPermitidos =  array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');

       //tamanho máximo (em bytes)
       $tamanhoPermitido = 1024*1024*100; //5mb

       //nome original do arquivo no computador do usuario
       $Imagem = $_FILES['Imagem']['name'];

       //o tipo do arquivo
       $ImagemType = $_FILES['Imagem']['type'];

       //o tamanho do arquivo
       $ImagemSize = $_FILES['Imagem']['size'];

       // o nome temporario do arquivo
       $ImagemTemp = $_FILES['Imagem']['tmp_name'];

       //codigos de possiveis erros na imagem
       $ImagemError = $_FILES['Imagem']['error'];

        if ($ImagemError === 0) {

            $upload = false;

            //veririca o tipo de arquivo enviado
            if (array_search($ImagemType, $tiposPermitidos) === false) {
                $_SESSION["msgError"] = "O tipo de arquivo enviado é inválido! (" . $Imagem . ")";
            } else if ($ImagemSize > $tamanhoPermitido) { //veririca o tamanho doa rquivo enviado
                $_SESSION["msgError"] = "O tamanho do arquivo enviado é inválido! (" . $Imagem . ")";
            } else { // não houve error, move o arquivo
                $upload = move_uploaded_file($ImagemTemp, $pasta . $Imagem);

                if (!$upload) {
                    $_SESSION["msgError"] = "Houve uma falha ao realizar o upload da imagem (" . $Imagem . ")";
                } else {
                    unlink('assets/images/slides/' . trim($arUser['Imagem']));
                }
            }
        }
    }

    if ($upload) {


        $data = array(           
            $Imagem,
            $_POST["StatusSlide"],          
            $_POST["codSlide"]

        );


        $result = $model->update($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Slide alterado com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível alterar o Slide no banco de dados !";
        }
    }
?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaSlides";
    </script>
<?php

} else if ($acao == "Delete") {

    $result = $model->delete($conDb, $_POST['codSlide']);

    if ($result) {
        $_SESSION["msgSucesso"] = "Slide excluído com sucesso !";

        //exclui as imagens no servidor
        unlink("assets/images/slides/" . trim($_POST["ExcluirImagem"]));       
    } else {
        $_SESSION["msgError"] = "Não foi possível excluir o Slide no banco de dados !";
    }

?>
    <script language="JavaScript">
        window.location = "<?= SITE_URL ?>listaSlides";
    </script>
<?php

}

?>
<script language="JavaScript">
    window.location = "<?= SITE_URL ?> listaSlides";
</script>
<?php
