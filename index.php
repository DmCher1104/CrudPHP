<?php
require_once 'config/connect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>
<style>
    th, td {
        padding: 10px;
    }

    th {
        background: #606060;
        color: white;
    }

    td {
        background: #b5b5b5;
    }
</style>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
    </tr>

    <?php
    $products = mysqli_query($connect, "SELECT * FROM `products`");
    $products = mysqli_fetch_all($products);
    foreach ($products as $product) {
        ?>

        <tr>
            <td><?= $product[0] ?></td>
            <td><?= $product[1] ?></td>
            <td><?= $product[3] ?></td>
            <td><?= $product[2] ?></td>
            <td><a style="color: blue" href="update.php?id=<?= $product[0] ?>">Update</a> </td>
            <td><a style="color: red" href="vendor/delete.php?id=<?= $product[0] ?>">Delete</a> </td>
        </tr>

        <?php
    }
    ?>

</table>
<h3> Add new product</h3>
<form action="vendor/create.php" method="post">
    <p>Title</p>
    <input type="text" name="title">
    <p>Description</p>
    <textarea name="description"></textarea>
    <p>Price</p>
    <input type="number" name="price">
    <br>
    <br>
    <button type="submit">Add new product</button>
</form>

</body>
</html>


