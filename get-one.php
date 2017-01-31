<?php
// include database and object files
include_once 'config/database.php';
include_once 'objects/wine.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$wine = new Wine($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of product to be edited
$wine->id = $data->id;

// read the details of product to be edited
$wine->readOne();

// create array
$product_arr[] = array(
  'id' => $wine->id,
  'name' => $wine->name,
  'year' => $wine->year,
  'grapes' => $wine->grapes,
  'picture' => $wine->picture,
  'country' => $wine->country,
  'region' => $wine->region,
  'description' => $wine->description
);

// make it json format
print_r(json_encode($product_arr));
?>
