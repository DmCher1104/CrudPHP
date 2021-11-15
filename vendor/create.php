<?php
require_once("../config/connect.php");


if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["price"])) {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        $targetDir = "../img/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


        if (empty($_FILES["file"]["name"])){
            //$sql = "INSERT INTO `products`(`title`, `price`, `description`) VALUES (?,?,?)";  для 3 способа
            $sql = "INSERT INTO `products`(`title`, `price`, `description`) VALUES (:title,:price ,:description)";
            $stmt = $connect->prepare($sql);
        }else {
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    $sql = "INSERT INTO `products`(`title`, `price`, `description`, `picture`) VALUES (:title,:price ,:description,:picture)";
                    $stmt = $connect->prepare($sql);
                    $stmt->bindValue(":picture", $fileName);
                }
            }
        }

        //1 способ
        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":price", $price);
        $stmt->execute();

        //2 способ
        //$affectedRowsNumber = $stmt->execute(array(":title" => $title, ":description" => $description, ":price" => $price));

        //3 способ
        //$affectedRowsNumber = $stmt->execute(array($title, $description,  $price));

        header('location: ../index.php');

    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
