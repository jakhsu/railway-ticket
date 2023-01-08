<?php
include_once 'db.php';

$request_method = $_SERVER["REQUEST_METHOD"];

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

switch ($request_method) {
  case 'GET':
    // retrive all members
    get_member($mysqli);
  case 'PUT':
  // add a new member
}

function get_member($mysqli)
{
  $query = 'SELECT * FROM test';
  $result = mysqli_query($mysqli, $query);
  if (!$result) {
    trigger_error(mysqli_error($mysqli), E_USER_ERROR);
  }
  while ($row = mysqli_fetch_array($result)) {
    $response[] = $row;
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

?>
