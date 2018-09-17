<?php

	require_once('class.phpmailer.php');

	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = ""; // sets the prefix to the servier
	$mail->Host = "mail.skylake.site"; // sets GMAIL as the SMTP server
	$mail->Port = 25; // set the SMTP port for the GMAIL server
	$mail->Username = "admin@skylake.site"; // GMAIL username
	$mail->Password = "Boy1662007"; // GMAIL password
	$mail->From = "admin@skylake.site"; // "name@yourdomain.com";
	$mail->FromName = "admin@skylake.site";  // set from Name
	$mail->Subject = "Test sending mail."; 
	$mail->Body = "My Body & <b>My Description</b>";

	$mail->AddAddress("boyskylab96@gmail.com"); // to Address

	$mail->Send(); 
?>
