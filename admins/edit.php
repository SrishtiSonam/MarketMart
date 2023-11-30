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
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="../index.php"> MarketMart</a></p>
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
                $adminposition = $_POST['adminposition'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $id = $_SESSION['id'];
                $edit_query = mysqli_query($con,"update admininfo set username='$adminposition', firstname='$firstname', lastname='$lastname', email='$email', password='$password' where Id=$id ") or die("error occurred");
                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                    </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
                }
              }else{
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"select * from admininfo where Id=$id ");
                while($result = mysqli_fetch_assoc($query)){
                    $res_Adminpos = $result['Username'];
                    $res_Fname = $result['Firstname'];
                    $res_Lname = $result['Lastname'];
                    $res_Email = $result['Email'];
                    $res_Password = $result['password'];
                }
            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="adminposition">Admin Position</label>
                    <input type="text" name="adminposition" id="adminposition" value="<?php echo $res_Adminpos; ?>" autocomplete="off" required>
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
                    <label for="password">Password</label>
                    <input type="text" name="password" id="password" value="<?php echo $res_Password; ?>" autocomplete="off" required>
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