<?php
require_once("../config/connect.php");

$statusMsg = '';
$product_id = $_POST['id'];

// File upload path
$targetDir = "../img/";                                             //specifies the directory where the file is going to be placed
$fileName = basename($_FILES["file"]["name"]);                   //return the filename from specified path
$targetFilePath = $targetDir . $fileName;                        //specifies the path of the file to be uploaded
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  //get the file extension

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"]) && isset($_POST["id"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $sql = "UPDATE `products` SET `picture` = :picture WHERE `products`.`id` = :product_id";
//            $sql = "INSERT INTO `products`(`picture`) where  VALUES (:picture)";
            $stmt = $connect->prepare($sql);
            $stmt->bindValue(":product_id", $product_id);
            $stmt->bindValue(":picture", $fileName);

            $affectedRowsNumber = $stmt->execute();
            if ($affectedRowsNumber > 0) {
                header('location: ../index.php');
            } else {
                $statusMsg = "File upload failed, please try again.";
            }
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    } else {
        $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
echo $statusMsg;
?>
