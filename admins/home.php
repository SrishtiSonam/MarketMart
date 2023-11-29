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
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">MarketMart</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con,"select * from admininfo where Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_id = $result['Id'];
            }
            echo "<a href='edit.php?Id=$res_id'>Change Profile</a>";
            ?>
            <a href="../php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>

    <main>
        <div class="box">
            <div class="top">
                <div class="box">
                    <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p>Choose any to edit existing or add new.</p> 
                </div>
            </div>
        </div>
    </main>
    <main>
        <div class="main-box">
            <div class="box"> 
                <button><a href="..\categories\home.php"><p>Choose to view the details of categories: </p></a></button>
            </div>
            <div class="box">
                <button><a href="..\categories\register.php"><p>Choose to add new categories: </p> </a></button>
            </div>
            <div class="box">
                <button><a href="..\categories\delete.php"><p>Choose to delete a categories: </p> </a></button>
            </div>
            <div class="box"> 
                <button><a href="..\products\home.php"><p>Choose to view the details of products: </p></a></button>
            </div>
            <div class="box"> 
                <button><a href="..\products\register.php"><p>Choose to add new products: </p></a></button>
            </div>
            <div class="box"> 
                <button><a href="..\products\delete.php"><p>Choose to delete a products: </p></a></button>
            </div>
        </div>
    </main>
</body>
</html>