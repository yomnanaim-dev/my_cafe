<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "verdant_cafe";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
  header("Content-Type: application/json");
  http_response_code(500);
  echo json_encode(array("error" => "Database connection failed"));
  exit;
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

?>