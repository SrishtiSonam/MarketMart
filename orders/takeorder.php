<?php 
   session_start();
   include("../php/connection.php");
   if(!isset($_SESSION['valid'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Take Order</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="../index.php">MarketMart</a> </p>
        </div>
        <div class="right-links">
            <a href="../php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p><b>Let the Shopping Begin</b></p>
            </div>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $productId = $_POST['product_id'];
                $orderedQuantity = $_POST['ordered_quantity'];
                $result = mysqli_query($con, "select quantity from products where productid = '$productId'");
                $row = mysqli_fetch_assoc($result);
                $availableQuantity = $row['quantity'];
                $res = mysqli_query($con, "select * from requests where productid = '$productId'");
                // echo "$productId";
            if ($orderedQuantity > 0 && $orderedQuantity <= $availableQuantity) {
                if (mysqli_num_rows($res)!=0){
                    mysqli_query($con, "update requests set orderquantity = orderquantity + '$orderedQuantity' where productid = '$productId'");
                }else{
                mysqli_query($con, "insert into requests (productid, orderquantity) VALUES ('$productId', '$orderedQuantity')");
                }
                mysqli_query($con, "update products set quantity = quantity - '$orderedQuantity' where productid = '$productId'");
                echo "Request placed successfully!";
            } else {
                echo "Invalid ordered quantity. Please enter a valid quantity.";
            }
        }

        $result = mysqli_query($con, "select * from products");

echo "<table class='Mytable'>";
echo "<tr>
        <th>ID</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Category ID</th>
        <th>Price</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Order Quantity</th>
        <th>Action</th>
        </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<form method='POST' action='".htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<tr>
            <td>{$row['Id']}</td>
            <td>{$row['productid']}</td>
            <td>{$row['productname']}</td>
            <td>{$row['categoryid']}</td>
            <td>{$row['price']}</td>
            <td>{$row['discription']}</td>
            <td>{$row['quantity']}</td>
            <td><input type='number' name='ordered_quantity' min='1' max='{$row['quantity']}'></td>
            <td><input type='submit' value='Place Request'>
                <input type='hidden' name='product_id' value='{$row['productid']}'></td>
            </tr>";
    echo "</form>";
}
echo "</table>";
?>
<div class="main-box">
    <div class="box">
        <p> To grab your receipt, simply click here. <br>Your bill is waiting for you!</p>
        <p><a href="bill.php"> Your bill!</a></p>
    </div>
</div>