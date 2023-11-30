<?php 
   session_start();
   include("../php/connection.php");
   if(!isset($_SESSION['valid'])){
        header("Location: login.php");
   }
    $updatePriceForOne = "update requests join products on requests.productid = products.productid set requests.priceforone = products.price";
    mysqli_query($con, $updatePriceForOne);
    $updatePriceForAll = "update requests set priceforall = orderquantity * priceforone";
    mysqli_query($con, $updatePriceForAll);
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Order Bill</title>
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
                <p><b>Your bill is here: </b></p>
            </div>
          </div>
          <div class="bottom">
                <?php
                    $result = mysqli_query($con, "select * from requests");
                    echo "<table class='Mytable'>";
                    echo "<tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price for One</th>
                    <th>Total Price</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['productid']}</td>
                        <td>{$row['orderquantity']}</td>
                        <td>{$row['priceforone']}</td>
                        <td>{$row['priceforall']}</td>
                        </tr>";
                    }
                    echo "</table>";
                    $totalamt = "select SUM(priceforall) as totalsum from requests";
                    $result1 = mysqli_query($con, $totalamt);
                    $totalitem = "select SUM(orderquantity) as totalitem from requests";
                    $result2 = mysqli_query($con, $totalitem);
                    if ($result) {
                        $row1 = $result1->fetch_assoc();
                        $sum = $row1['totalsum'];
                        $row2 = $result2->fetch_assoc();
                        $quan = $row2['totalitem'];
                        echo "<div class='message'>
                                <p>The total amount is $sum for $quan items.</p>
                                <p>Current Date: " . date('Y-m-d') . " and Current Time: " . date('H:i:s') . "</p>
                              </div> <br>";
                              mysqli_query($con, "insert into orders (quantity, totalamount, date, time) VALUES ('$quan', '$sum', CURDATE(), CURTIME())") or die("Error Occurred");
                    } else {
                        echo "<div class='message'>
                            <p>Error while fetching the record!!</p>
                        </div> <br>";
                    }
                ?>
          </div>
       </div>
    </main>
    <?php
    echo "<a href='./takeorder.php'><button class='btn'>Go Back</button>";
    ?>
</body>
</html>