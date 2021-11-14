<?php
require_once("../config/connect.php");

$product_id = $_POST['id'];
if (isset($_POST['id'])) {
    try {
        $product_id = $_POST['id'];
        echo $product_id;
        $sql = "DELETE FROM `products` WHERE `products`.`id` = :product_id";

        $stmt = $connect->prepare($sql);
        $stmt->bindValue(":product_id", $product_id);
        $stmt->execute();
        header('Location:/');
    } catch (PDOException $e){
        echo "Database error: " . $e->getMessage();
    }

}else{
    echo "There is no product with this id";
}

?>