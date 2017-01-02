<?php

	include "dbsettings.php";

	if (isset($_POST["change-password"])){
		$email = $_POST["email"];
		$password = $_POST["new_password"];
		$password_confirm = $_POST["new_password_again"];
		$hash = $_POST["q"];

		$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
		$resetkey = hash('sha512', $salt.$email);

		if ($resetkey == $hash){
			if ($password == $password_confirm){
				$password = hash('sha512',$salt.$password);

				    $sql  = 'BEGIN SP_REFRESH_PASSWORD(:e_mail,:new_pw,:is_valid); END;';
				    $stmt = oci_parse($conn, $sql);

				    oci_bind_by_name($stmt, ':e_mail', $email);
				    oci_bind_by_name($stmt, ':new_pw', $password);
				    oci_bind_by_name($stmt, ':is_valid', $message);

				    oci_execute($stmt);
			}
			else{

			}
		}
		else{

		}
	}
?>