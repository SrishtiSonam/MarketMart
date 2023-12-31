<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Delete Categories</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
        <?php 
         include("../php/connection.php");
         if(isset($_POST['submit'])){
            $categoryid = $_POST['categoryid'];
            $verify_query = mysqli_query($con,"select categoryid from categories where categoryid='$categoryid'");
            if(mysqli_num_rows($verify_query) ==0 ){
                echo "<div class='message'>
                        <p>Item with such category id does not exist!</p>
                      </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }else{
                mysqli_query($con,"delete from categories where categoryid='$categoryid'") or die("Erroe Occured");
                mysqli_query($con,"delete from products where categoryid='$categoryid'") or die("Erroe Occured");
                echo "<div class='message'>
                          <p>Deleted successfully!</p>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>View all categories</button>";
            }
         }else{
        ?>
            <header>Delete category</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="categoryid">Enter category Id to delete it: </label>
                    <input type="text" name="categoryid" id="categoryid" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Delete It" required>
                </div>
                <div class="links">
                    View list of categories <a href="home.php">categories</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>