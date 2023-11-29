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
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"> MarketMart</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="../php/logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['Password'];
                $id = $_SESSION['id'];
                $edit_query = mysqli_query($con,"update userinfo set username='$username', firstname='$firstname', lastname='$lastname', email='$email', age='$age' where id=$id ") or die("error occurred");
                $edit_query = mysqli_query($con,"update logindata set password='$password' where email='$email' ") or die("error occurred");
                if($edit_query){
                    echo "<div class='message'>
                        <p>Profile Updated!</p>
                        </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
                }
                }else{
                $id = $_SESSION['id'];
                $query1 = mysqli_query($con,"select * from userinfo where id=$id ");
                while($result = mysqli_fetch_assoc($query1)){
                    $res_Uname = $result['Username'];
                    $res_Fname = $result['Firstname'];
                    $res_Lname = $result['Lastname'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                    $query2 = mysqli_query($con,"select * from logindata where email='$res_Email' ");
                    while($res = mysqli_fetch_assoc($query2)){
                        $res_Password = $res['password'];
                    }
                }
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $res_Fname; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $res_Lname; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="text" name="Password" id="Password" value="<?php echo $res_Password; ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>