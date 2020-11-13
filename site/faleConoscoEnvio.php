<?php


// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'assets/util/phpmailer/vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer();

$mail->isSMTP();
$mail->Charset     = "UTF-8";                          // identificação da língua de reprodução (português)
$mail->STMPAuth    = true;                             // ativa o SMTP autenticado
$mail->SMTPSecure  = "tls";                            // tipo de segurança utilizado
$mail->Host        = "smtp.gmail.com";  // identifica o host utilizado no disparo (gmail)
$mail->SMTPDebug  = 2;                
$mail->Port        = 587;                              // indica a porta utilizada
$mail->Username    = "contatolitterae.arte@gmail.com"; // usuário de e-mail para autenticação
$mail->Password    =  "hi123456gor";                   // senha de e-mail para autenticação
$mail->From        = $_POST["Email"];                  // e-mail do remetente
$mail->FromName    = $_POST["Nome"];                   // nome do remetente
$mail->addAddress("contatolitterae.arte@gmail.com");   // e-mail destinatário
$mail->isHTML(false);                                   // formato do texto de saída
$mail->Subject     = $_POST["TipoProjeto"];              // assunto (título do e-mail)
$mail->Body        = $_POST["Descricao"];          // Corpo do e-mail em HTML (destinado ao texto geral)
// $mail->AltBody     = $cTextoCorpo;                  // corpo do texto em txt
// $mail->addAttachment($arquivo['tmp_name'], $arquivo['name']);

if ($mail->send()) {
   $_SESSION["msgSucesso"] = "E-mail de contato encaminhado com sucesso, em breve sua resposta será enviada";
} else {
   $_SESSION["msgError"] = $mail->ErrorInfo;
}

?>

<script language="JavaScript">
   window.location = "<?= SITE_URL ?>contato";
</script>
<?php
?>