<?php
  header('Content-Type: application/json');
  $connection = mysqli_connect("localhost", "root", "", "test");
  mysqli_set_charset($connection, 'utf8');


  $result = mysqli_query($connection, "SELECT * FROM deneme");
  $data   = array();

  while ($row = mysqli_fetch_array($result)) {
    $row_data = array(
      'id' => $row[0],
      'ad' => $row[1],
      'soyad' => $row[2],
      'yetenek' => $row[3],
      'seviye' => $row[4]
    );
    array_push($data, $row_data);
  }

  echo json_encode($data);
?>