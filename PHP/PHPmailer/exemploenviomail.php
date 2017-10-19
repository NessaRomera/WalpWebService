<?php
//SMTP precisa de timing preciso, � necess�rio ajustar a zona de hor�rio
//Deve ser feito no php.ini, mas d� para quebrar um galho por aqui
date_default_timezone_set('America/Sao_Paulo');

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once('phpmailer/PHPMailerAutoload.php');//j� tentei sem ../ tamb�m
// Inicia a classe PHPMailer
$mail = new PHPMailer();
// Define os dados do servidor e tipo de conex�o
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(true); // Define que a mensagem ser� SMTP
$mail->Host = "smtp.gmail.com"; // Endere�o do servidor SMTP
$mail->Port = 587;
$mail->SMTPAuth = true; // Usa autentica��o SMTP? (opcional)
//$mail->SMTPSecure = 'ssl';
$mail->SMTPSecure = 'tls';
$mail->Username = 'meuusuario@gmail.com'; // Usu�rio do servidor SMTP
$mail->Password = 'minhasenha'; // Senha do servidor SMTP
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = "meuusuario@gmail.com"; // Seu e-mail
$mail->FromName = "Fulano enviador de mails"; // Seu nome
// Define os destinat�rio(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('destinatario@yahoo.com.br', 'Recipiente travesso de mensagens');
// Define os dados t�cnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "Mensagem Teste"; // Assunto da mensagem
$mail->Body = "Este � o corpo da mensagem de teste, em <b>HTML</b>!  :)";
$mail->AltBody = "Este � o corpo da mensagem de teste, em Texto Plano! \r\n :)";
// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
$mail->Debugoutput = 'html';//Ask for HTML-friendly debug output
//$mail->SMTPDebug = 2; //Descomente para ver a conversa SMTP se houver problema e quiser investigar
$enviado = $mail->Send();
// Limpa os destinat�rios e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
// Exibe uma mensagem de resultado
if ($enviado) {
  echo "E-mail enviado com sucesso!";
}
else {
  echo "N�o foi poss�vel enviar o e-mail.";
  echo "<b>Informa��es do erro:</b> " . $mail->ErrorInfo;
}
?>