<?php
require_once("../config/connect.php");


if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])) {
    $product_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE `products` SET `title` = :title, `price` = :price, `description` = :description WHERE `products`.`id` = :product_id";

    $stmt = $connect->prepare($sql);

    $stmt->bindValue(":product_id", $product_id);
    $stmt->bindValue(":title", $title);
    $stmt->bindValue(":description", $description);
    $stmt->bindValue(":price", $price);

    $stmt->execute();

    header('location: ../index.php');

}else{
    echo "Incorrect data";
}
?>