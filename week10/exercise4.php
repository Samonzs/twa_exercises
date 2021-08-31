<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Week 10 Exercise 1</title>
        <link rel="stylesheet" href=" ../css/week10Styles.css">
    </head>
    <body>
        <?php
            $quantity = $_POST["quantity"];
            require_once("conn.php");

            if(is_numeric($quantity)){
                $sql = "SELECT name, quantityInStock, price FROM product WHERE quantityInStock > $quantity ORDER BY quantityInStock";
                $results = $dbConn->query($sql)
                or die ('Problem with query: ' . $dbConn->error);
            }

        ?>



        <?php

        if(!is_numeric($quantity)):
            echo "<p class = 'errorMsg'>The value entered for the quantity was not a number.</p>";

        elseif(mysqli_num_rows($results) == 0):
            echo "<p class = 'errorMsg'>There are no products that have more than $quantity in stock.</p>";


        else:?>
        <h1>Products with stock > <?php echo "$quantity" ?> </h1>
        <table>
            <tr>
                <th>Name </th>
                <th>Quantity In Stock</th>
                <th>Price</th>
            </tr>

        <?php
            while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["name"]?></td>
                    <td><?php echo $row["quantityInStock"]?></td>
                    <td><?php echo $row["price"]?></td>
                </tr>
            <?php }
            endif;
            $dbConn->close(); ?>
        </table>
    </body>
</html>
