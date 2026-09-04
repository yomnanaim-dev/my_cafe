<?php

require "config.php";

$name = isset($_POST["name"]) ? mysqli_real_escape_string($conn, $_POST["name"]) : "";
$category = isset($_POST["category"]) ? mysqli_real_escape_string($conn, $_POST["category"]) : "";
$price = isset($_POST["price"]) ? (float)$_POST["price"] : 0;
$size = isset($_POST["size"]) ? mysqli_real_escape_string($conn, $_POST["size"]) : "Regular";

if ($name === "" || $category === "" || $price <= 0) {
  http_response_code(400);
  echo json_encode(array("error" => "Missing required fields"));
  exit;
}

$image_path = "";

if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
  $allowed = array("jpg", "jpeg", "png");
  $ext = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

  if (in_array($ext, $allowed)) {
    $new_name = uniqid() . "." . $ext;
    $target = "uploads/" . $new_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    $image_path = $target;
  }
}

$sql = "INSERT INTO products (name, category, price, size, active, image) VALUES ('$name', '$category', $price, '$size', 1, '$image_path')";

if (mysqli_query($conn, $sql)) {
  $new_id = mysqli_insert_id($conn);
  echo json_encode(array(
    "id" => $new_id,
    "name" => $name,
    "category" => $category,
    "price" => $price,
    "size" => $size,
    "active" => true,
    "image" => $image_path
  ));
} else {
  http_response_code(500);
  echo json_encode(array("error" => mysqli_error($conn)));
}

mysqli_close($conn);

?>