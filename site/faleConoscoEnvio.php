<?php


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require_once 'assets/util/phpmailer/vendor/autoload.php';

$TipoProjeto = "";

if ($_POST['TipoProjeto'] == 1 ? $TipoProjeto =  "Parede Personalizada" : ($_POST['TipoProjeto'] == 2 ? $TipoProjeto = "Quadro Personalizado" : ($_POST['TipoProjeto'] == 3 ? $TipoProjeto = "Lettering para publicidade" : $TipoProjeto = "Lettering Geral")));

$mensagem = "Orçamento para " . $TipoProjeto . "<br><br> <p> Altura: " . $_POST['Altura'] . "<br>Largura: " . $_POST['Largura'] . "<br><br>Descrição:<br>" . $_POST['Descricao'] . "</p><br>Realizado por: " . $_POST['Nome'] . "<br>Email: <a href= mailto:".$_POST['Email'].">" . $_POST['Email']. "</a>";
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();

$mail->isSMTP();
$mail->CharSet      = "UTF-8";
$mail->SMTPAuth     = true;                             // Ativa o SMTP autenticado
$mail->SMTPSecure   = "tls";                            // Tipo de segurança
$mail->Host         = "smtp.gmail.com";
$mail->Port         = 587;
$mail->Username     = "contatolitterae.arte@gmail.com";       // Usuário de e-mail para autenticação
$mail->Password     = "hi123456gor";                       // Senha do e-mail de autenticação
$mail->From         = $_POST["Email"];                  // E-mail remetente
$mail->FromName     = $_POST["Nome"];                   // Nome do Remetente

$mail->addAddress("contatolitterae.arte@gmail.com", "Litterae - Orçamento");    // E-mail Destinatário
$mail->isHTML(true);                                   // formato do texto de saída
$mail->Subject     = "Orçamento Solicitado";              // assunto (título do e-mail)
$mail->Body        = $mensagem;          // Corpo do e-mail em HTML (destinado ao texto geral)
for($ct=0;$ct<count($_FILES['arquivo']['tmp_name']);$ct++)
{
    $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['arquivo']['name'][$ct]));
    $filename =$_FILES['arquivo']['name'][$ct];
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'][$ct], $uploadfile)) {
        $mail->addAttachment($uploadfile, $filename);
    }

}
// $mail->AltBody     = $cTextoCorpo;                  // corpo do texto em txt
// $mail->addAttachment($arquivo['tmp_name'], $arquivo['name']);

if ($mail->send()) {
   $_SESSION["msgSucesso"] = "Obrigado por entrar em contato conosco! Sua resposta será enviada o mais breve possível! :D";
} else {
   $_SESSION["msgError"] = $mail->ErrorInfo;
}

?>

<script language="JavaScript">
   window.location = "<?= SITE_URL ?>contato";
</script>
<?php
?>