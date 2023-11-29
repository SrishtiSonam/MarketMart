<?php 
   session_start();
   include("../php/config.php");
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
    <title>Order Bill</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">MarketMart</a> </p>
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
                    echo "<table class='Billtable'>";
                    echo "<tr>
                    <th>ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['productid']}</td>
                        <td>{$row['quantity']}</td>
                        </tr>";
                    }
                    echo "</table>";
                ?>
          </div>
       </div>
    </main>
    <?php
        mysqli_query($con, "delete from requests");
    ?>
</body>
</html>