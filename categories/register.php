<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
         include("../php/connection.php");
         if(isset($_POST['submit'])){
            $categoryid = $_POST['categoryid'];
            $categoryname = $_POST['categoryname'];
            $availability = $_POST['availability'];
            $verify_query = mysqli_query($con,"select categoryid from categories where categoryid='$categoryid'");
            if(mysqli_num_rows($verify_query) !=0 ){
                echo "<div class='message'>
                        <p>Item with same category id already exist!</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }else{
                mysqli_query($con,"insert into categories(categoryid, categoryname, availability) values ('$categoryid','$categoryname','$availability')") or die("Erroe Occured");
                echo "<div class='message'>
                          <p>Added successfully!</p>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>View all Categories</button>";
            }
         }else{
        ?>
            <header>Add categories</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="categoryid">Category Id</label>
                    <input type="text" name="categoryid" id="categoryid" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="categoryname">Category Name</label>
                    <input type="text" name="categoryname" id="categoryname" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="availability">Availability [Y/N]</label>
                    <input type="text" name="availability" id="availability" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    View list of categories <a href="home.php">Home Page</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>