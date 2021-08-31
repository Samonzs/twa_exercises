<!-- Ali Salman , 20056663, Campbelltown Campus  -->

<?php
    $value = 0;
    require_once("conn.php");

    if(isset($_POST["quantity"])) {
    $quantity = $_POST["quantity"];

    if(is_numeric($quantity)){
        $sql = "SELECT name, quantityInStock, price FROM product WHERE quantityInStock > $quantity ORDER BY quantityInStock";
        $results = $dbConn->query($sql)
        or die ('Problem with query: ' . $dbConn->error);

        if(mysqli_num_rows($results) == 0){
            $value = 2;
        }
    }

    if(!is_numeric($quantity)){
        $value = 1;
    }
}

?>


<?php
if($value == 1):
    echo "<p class = 'errorMsg'>The value entered for the quantity was not a number.</p>";

elseif($value == 2):
    echo "<p class = 'errorMsg'>There are no products that have more than $quantity in stock.</p>";

else:?>
<?php if(isset($_POST["quantity"])): ?>
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

<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <style>
          input[type="text"] {border: 1px solid black;}
        </style>
        <link rel="stylesheet" href="../css/week10Styles.css">
        <title>Week 8 Exercise 4 Form</title>
    </head>
    <body>

        <form id="exercise5Form" method="post" action="exercise5.php">
          <h1>Quantity in Stock</h1>
          <p>Please enter the quantity to check against stock levels</p>
          <p>
              <label for="quantity">Quantity: </label>
              <input type="text" name="quantity" size="10" id="quantity" maxlength="6">
          </p>
          <p><input type="submit" name="submit"></p>
      </form>

    </body>
</html>
