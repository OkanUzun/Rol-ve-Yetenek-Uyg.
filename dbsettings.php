<?php
  $conn = oci_connect("roleaby", "roleaby123", "//localhost/orcl", "AL32UTF8");
  if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
  }
?>