<?php
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {

     echo "No arguments Provided!";
	    return false;
}

/*** DADOS A SEREM ALTERADOS DE ACORDO COM SUAS CONFIGURAÇÕES DE E-MAIL ***/
$enviaFormularioParaNome = 'Roberto Nicoletti';
$enviaFormularioParaEmail = 'roberto@nicoletti.eti.br';

$caixaPostalServidorNome = 'Portifolio | Formulário';
$caixaPostalServidorEmail = 'roberto@nicoletti.eti.br';
$caixaPostalServidorSenha = 'SUA SENHA DE E-MAIL';


/* abaixo as veriaveis principais, que devem conter em seu formulario*/
$remetenteNome  = $_POST["name"];
$remetenteEmail = $_POST['email'];
$assunto  = 'Formulário Portifolio';
$remetentephone = $_POST['phone'];
$mensagem = $_POST['message'];


$mensagemConcatenada = 'Formulário gerado via website'.'<br/>';
$mensagemConcatenada .= '-------------------------------<br/><br/>';
$mensagemConcatenada .= 'Nome: '.$remetenteNome.'<br/>';
$mensagemConcatenada .= 'E-mail: '.$remetenteEmail.'<br/>';
$mensagemConcatenada .= 'Telefone: '.$remetentephone.'<br/>';
$mensagemConcatenada .= 'Assunto: '.$assunto.'<br/>';
$mensagemConcatenada .= '-------------------------------<br/><br/>';
$mensagemConcatenada .= $mensagem.'<br/>';


/*********************************** A PARTIR DAQUI NAO ALTERAR ************************************/

require_once('PHPMailer-master/PHPMailerAutoload.php');

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth  = true;
$mail->Charset   = 'utf8_decode()';
$mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
$mail->Port  = '587';
$mail->Username  = $caixaPostalServidorEmail;
$mail->Password  = $caixaPostalServidorSenha;
$mail->From  = $caixaPostalServidorEmail;
$mail->FromName  = utf8_decode($caixaPostalServidorNome);
$mail->IsHTML(true);
$mail->Subject  = utf8_decode($assunto);
$mail->Body  = utf8_decode($mensagemConcatenada);


$mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

if(!$mail->Send()) {
  $mensagemRetorno = 'Erro ao enviar formulário: '. print($mail->ErrorInfo);
  return false;
}
else {
  $mensagemRetorno = 'Formulário enviado com sucesso!';
  return true;
}

?>
