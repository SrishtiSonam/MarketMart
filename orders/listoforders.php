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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Orders</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p><b>Order History</b></p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>Every purchase in history:- </p> 
            </div>
                <?php
                    $result = mysqli_query($con, "select * from orders");
                    echo "<table class='Mytable'>";
                    echo "<tr>
                        <th>ID</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['totalamount']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['time']}</td>
                        </tr>";
                    }
                    echo "</table>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
                ?>
          </div>
       </div>              
    </main>
    </body>
</html>