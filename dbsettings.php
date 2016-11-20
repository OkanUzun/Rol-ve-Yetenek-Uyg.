<?php 
	$conn = oci_connect("system", "oracle", "//localhost/orcl");
	if (!$conn) {
	   $m = oci_error();
	   echo $m['message'], "\n";
	   exit;
	}
?>