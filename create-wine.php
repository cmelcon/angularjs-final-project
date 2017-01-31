<?php
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

include_once 'objects/wine.php';
$wine = new Wine($db);

$data = json_decode(file_get_contents("php://input"));

$wine->name = $data->name;
$wine->year = $data->year;
$wine->grapes = $data->grapes;
$wine->picture = $data->picture;
$wine->country = $data->country;
$wine->region = $data->region;
$wine->description = $data->description;

if($wine->create()){
  echo "Wine was created.";
}else {
  echo "Unable to created wine.";
}
?>
