<?php

require "config.php";

$id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
$name = isset($_POST["name"]) ? mysqli_real_escape_string($conn, $_POST["name"]) : "";
$category = isset($_POST["category"]) ? mysqli_real_escape_string($conn, $_POST["category"]) : "";
$price = isset($_POST["price"]) ? (float)$_POST["price"] : 0;
$size = isset($_POST["size"]) ? mysqli_real_escape_string($conn, $_POST["size"]) : "Regular";
$active = isset($_POST["active"]) ? (int)$_POST["active"] : 1;

if ($id <= 0 || $name === "" || $category === "") {
  http_response_code(400);
  echo json_encode(array("error" => "Missing required fields"));
  exit;
}

$image_sql = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
  $allowed = array("jpg", "jpeg", "png");
  $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

  if (in_array($ext, $allowed)) {
    $new_name = uniqid() . "." . $ext;
    $target = "uploads/" . $new_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    $image_sql = ", image = '" . $target . "'";
  }
}

$sql = "UPDATE products SET name = '$name', category = '$category', price = $price, size = '$size', active = $active" . $image_sql . " WHERE id = $id";

if (mysqli_query($conn, $sql)) {
  echo json_encode(array("success" => true));
} else {
  http_response_code(500);
  echo json_encode(array("error" => mysqli_error($conn)));
}

mysqli_close($conn);

?>