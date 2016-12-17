<?php
  header('Content-Type: application/json');
  include "dbsettings.php";

  $sql = "SELECT T_ABILITY.PK, T_ABILITY.ABILITY_NAME FROM T_ABILITY";

  $stmt = oci_parse($conn, $sql);
  $r    = oci_execute($stmt);

  $data = array();

  while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
    $row_data = array(
      'id' => $row["PK"],
      'ability' => $row["ABILITY_NAME"]
    );
    array_push($data, $row_data);
  }

  echo json_encode($data);
?>