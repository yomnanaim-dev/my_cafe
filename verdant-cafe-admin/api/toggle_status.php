<?php

require "config.php";

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
$active = isset($_POST["active"]) ? (int)$_POST["active"] : 0;

if ($id <= 0) {
  http_response_code(400);
  echo json_encode(array("error" => "Missing id"));
  exit;
}

$sql = "UPDATE products SET active = $active WHERE id = $id";

if (mysqli_query($conn, $sql)) {
  echo json_encode(array("success" => true));
} else {
  http_response_code(500);
  echo json_encode(array("error" => mysqli_error($conn)));
}

mysqli_close($conn);

?>