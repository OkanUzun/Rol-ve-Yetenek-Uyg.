<?php 
	
	include "dbsettings.php";

	if (isset($_POST["forgot-password"])){
		if (filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
			$email = $_POST["email"];
		}
		else{
			echo "email is not valid";
			exit;
		}

		$sql = "SELECT EMAIL FROM T_USER WHERE EMAIL = '$email'";

	    $stmt = oci_parse($conn, $sql);
	    $r    = oci_execute($stmt);
	    $row  = oci_fetch_assoc($stmt);

	    echo $row["EMAIL"];

	    if ($row["EMAIL"]){
	    	require 'mail-config.php';
	    	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
	    	$password = hash('sha512', $salt.$row["EMAIL"]);
	    	$pwrurl = "localhost/reset-password.php?q=".$password;

	   		$mail->addAddress($email);
	      	$mail->Subject = 'Şifre Sıfırlama Bağlantısı';
	      	$mail->Body    = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.yoursitehere.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nThe Administration";

	      	if (!$mail->send()) {
	        	echo 'Message could not be sent.';
	        	echo 'Mailer Error: ' . $mail->ErrorInfo;
	      	}
	      	else {
	        	echo 'Message has been sent';
	      	}


	    }
	}
?>