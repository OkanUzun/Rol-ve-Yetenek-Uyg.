<?php
$connection = mysqli_connect("localhost", "root", "", "test");
mysqli_set_charset($connection, 'utf8');


$result2 = mysqli_query($connection, "SELECT * FROM yetenek");
$data2 = array();
while ($row2 = mysqli_fetch_array($result2)) {
  $row_data2 = array(
    'a' =>$row2[0],
    'b' =>$row2[1],
    'c' =>$row2[2]
  );
  array_push($data2, $row_data2);
}

echo json_encode($data2);
?>