<?php
require_once("config/connect.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="device-width, initial-scale=1">
    <title>Products</title>

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
<div class="container p-0 mx-auto m-4 ">
    <h3> Table of products</h3>
    <table class="table table-stripped table-hover">
        <thead class="thead-light w-100">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
        </tr>
        </thead>
        <tbody>

        <?php
        try {
            $sql = "SELECT * FROM products";
            $products = $connect->query($sql);
            while ($row = $products->fetch()) {
                ?>

                <tr>
                    <th scope="row"><?= $row["id"] ?></th>
                    <td><?= $row["title"] ?></td>
                    <td><?= $row["description"] ?></td>
                    <td><?= $row["price"] ?></td>
                    <td>
                        <form action="updatePage.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="<?= $row["id"] ?>">
                                <button type="submit" class="btn btn-info mb-2">Update</button>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form action="vendor/delete.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="id" id="id" value="<?= $row["id"] ?>">
                                <button type="submit" class="btn btn-danger mb-2">Delete</button>
                            </div>
                        </form>
                    </td>
                </tr>

                <?php
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        ?>
        </tbody>
    </table>
</div>

<div class="container mx-auto bg-info py-2">
    <h3> Add new product</h3>
    <form action="vendor/create.php" method="post">
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlInput1" placeholder="description"
                      rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Price</label>
            <input type="number" name="price" class="form-control" id="exampleFormControlInput1" placeholder="price">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Add new product</button>
    </form>
</div>


</body>
</html>


