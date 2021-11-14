<?php
require_once("config/connect.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Update product(s)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
$product_id = $_POST['id'];
//-----------
echo $product_id;
echo "<br>";
var_dump($product_id);
echo "<br>";
//------------
$sql = "SELECT * FROM `products` WHERE `id`=:product_id";

$stmt = $connect->prepare($sql);
$stmt->bindValue(":product_id", $product_id);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    foreach ($stmt as $row) {
        $title = $row["title"];
        $description = $row["description"];
        $price = $row["price"];
    }
    ?>
    <div class="container mx-auto bg-info py-2 my-3">
        <h3> Update product</h3>
        <form action="vendor/update.php" method="post">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $product_id ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Title</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1"
                       value="<?= $title ?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Description</label>
                <textarea class="form-control" name="description" id="exampleFormControlInput1"
                          rows="3"><?= $description ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Price</label>
                <input type="number" name="price" class="form-control" id="exampleFormControlInput1"
                       value="<?= $price ?>">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Save changes</button>
        </form>
    </div>
    <?php
} else {
    echo "Product not found";
}

?>

</body>
</html>

