<?php
	$conn = oci_connect("system", "oracle", "//localhost/orcl", "AL32UTF8");
	if (!$conn) {
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
?>