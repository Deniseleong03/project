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
    $lowest_selling_query = "SELECT products.id, products.name, SUM(orderdetails.quantity) as total_sales 
                         FROM orderdetails 
                         JOIN products ON orderdetails.product_id = products.id 
                         GROUP BY products.id 
                         ORDER BY total_sales ASC 
                         LIMIT 5"; // you can change the limit to show more or fewer products
    
    $lowest_selling_stmt = $con->prepare($lowest_selling_query);
    $lowest_selling_stmt->execute();

    // check if more than 0 record found
    $num = $lowest_selling_stmt->rowCount();

    if ($num > 0) {
        // display products in a grid format
        echo "<div class='container'>";
        echo "<h2>Lowest Selling Products</h2>";
        echo "<div class='row'>";

        while ($row = $lowest_selling_stmt->fetch(PDO::FETCH_ASSOC)) {
            // extract row
            extract($row);

            // display product
            echo "<div class='col-md-4'>";
            echo "<h4><a href='product.php?id={$id}'>{$name}</a></h4>";
            echo "<p>Total Sales: {$total_sales}</p>";
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