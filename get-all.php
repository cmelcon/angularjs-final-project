<?php

include_once('config/database.php');
include_once('objects/wine.php');
$database = new Database();
$db = $database->getConnection();


$wine = new Wine($db);

$stmt = $wine->readAll();
$num = $stmt->rowCount();

if($num > 0) {
  $data = "";
  $x = 1;

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $data .= '{';
      $data .= '"id": "' . $id . '",';
      $data .= '"name": "' . $name . '",';
      $data .= '"year": "' . $year . '",';
      $data .= '"country": "' . $country . '",';
      $data .= '"grapes": "' . $grapes . '",';
      $data .= '"picture": "' . $picture . '",';
      $data .= '"region": "' . $region . '",';
      $data .= '"description": "' . $description . '"';
      $data .= '}';

      $data .= $x<$num ? ',' : '';

      $x++;

  }
}

echo '{"records": [' . $data . ']}';
