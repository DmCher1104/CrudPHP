<?php
require_once("../config/connect.php");


if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])) {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        //$sql = "INSERT INTO `products`(`title`, `price`, `description`) VALUES (?,?,?)";  для 3 способа
        $sql = "INSERT INTO `products`(`title`, `price`, `description`) VALUES (:title,:price ,:description)";

        $stmt = $connect->prepare($sql);

        //1 способ
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":price", $price);
        $affectedRowsNumber = $stmt->execute();

        //2 способ
        //$affectedRowsNumber = $stmt->execute(array(":title" => $title, ":description" => $description, ":price" => $price));

        //3 способ
        //$affectedRowsNumber = $stmt->execute(array($title, $description,  $price));


        if ($affectedRowsNumber > 0) {
            echo "Data successfully added: title=$title  description= $description  price= $price";
        }

        header('location: ../index.php');

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>

<!--"DELETE FROM `products` WHERE `products`.`id` = 9"-->
