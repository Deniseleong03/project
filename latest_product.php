<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<body>
    <?php
    // include database connection
    include 'config/database.php';

    // query to select the lowest selling products
    // query to select the latest products
    $latest_query = "SELECT * FROM products ORDER BY created DESC LIMIT 5";
    $latest_stmt = $con->prepare($latest_query);
    $latest_stmt->execute();

    // check if more than 0 record found
    $num = $latest_stmt->rowCount();

    if ($num > 0) {
        // display products in a grid format
        echo "<div class='container'>";
        echo "<h2>Latest Products</h2>";
        echo "<div class='row'>";

        while ($row = $latest_stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            extract($row);

            // display product
            echo "<div class='col-md-4'>";
            echo "<h4><a href='product.php?id={$id}'>{$name}</a></h4>";
           
            echo "<p>Price: {$price}</p>";
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
    }
    // if no records found
    else {
        echo "<div class='alert alert-danger'>No records found.</div>";
    }

    ?>



</body>