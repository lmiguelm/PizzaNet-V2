<?php

	require_once('../phpmailer/class.phpmailer.php');

	$mail = new PHPMailer();

	$mail->IsSMTP();

	$mail->Host = 'smtp.gmail.com';

	$mail->SMTPAuth = true;

	$mail->Username = 'pizzanetifsp@gmail.com';

	$mail->Password='pizzanet123';

	$mail->SMTPSecure = 'tls';

	$mail->Port = 587;

	$mail->From = $emissor;

	$mail->FromName = $nome_emissor;

	$mail->AddAddress($receptor, $nome_receptor);

	$mail->IsHTML(true);

	$mail->CharSet = 'UTF-8';

	$mail->Subject = $subject;

	$mail->Body = "<html>
	                <head>
	                    <meta charset='utf-8' />
	                    </head>
	                    <body>$mensagem</body>
						</html>";
	                                
	                                
	 $mail->AltBody = $mensagem;
	 
	 if(!$mail->Send()){
	     echo 'Mensagem nao pode ser enviado';
	     echo $mail->ErrorInfo();
	     exit;
	 }
	
 ?>