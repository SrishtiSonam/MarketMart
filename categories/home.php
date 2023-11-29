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
    <title>Categories</title>
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
                <p><b>Let the Shopping Begin</b></p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>We have following categories:- </p> 
            </div>
                <?php
                    $result = mysqli_query($con, "select * from categories");
                    echo "<table class='Mytable'>";
                    echo "<tr>
                    <th>ID</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Availability</th>
                    </tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['categoryid']}</td>
                        <td>{$row['categoryname']}</td>
                        <td>{$row['availability']}</td>
                        </tr>";
                    }
                    echo "</table>";
                ?>
          </div>
       </div>

    </main>
</body>
</html>