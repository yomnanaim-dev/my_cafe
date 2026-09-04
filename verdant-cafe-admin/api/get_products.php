<?php

require "config.php";

$search = isset($_GET["search"]) ? mysqli_real_escape_string($conn, $_GET["search"]) : "";

if ($search !== "") {
  $sql = "SELECT * FROM products WHERE name LIKE '%" . $search . "%' ORDER BY id DESC";
} else {
  $sql = "SELECT * FROM products ORDER BY id DESC";
}

$result = mysqli_query($conn, $sql);

$products = array();

while ($row = mysqli_fetch_assoc($result)) {
  $products[] = array(
    "id" => (int)$row["id"],
    "name" => $row["name"],
    "category" => $row["category"],
    "price" => (float)$row["price"],
    "size" => $row["size"],
    "active" => (bool)$row["active"],
    "image" => $row["image"]
  );
}

echo json_encode($products);

mysqli_close($conn);

?>