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
            $productid = $_POST['productid'];
            $productname = $_POST['productname'];
            $categoryid = $_POST['categoryid'];
            $price = $_POST['price'];
            // $image = $_POST['image'];
            $discription = $_POST['discription'];
            $quantity = $_POST['quantity'];
            $verify_query = mysqli_query($con,"select productid from products where productid='$productid'");
            if(mysqli_num_rows($verify_query) !=0 ){
                echo "<div class='message'>
                      <p>This product already exist, Try another One Please!</p>
                  </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }else{
                mysqli_query($con,"insert into products (productid,productname,categoryid,price,discription,quantity) values ('$productid','$productname','$categoryid','$price','$discription',$quantity)") or die("Erroe Occured");
                echo "<div class='message'>
                      <p>Added successfully!</p>
                  </div> <br>";
                echo "<a href='login.php'><button class='btn'>Login Now</button>";
            }
        }else{
        ?>
            <header>Add a product</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="productid">Product Id</label>
                    <input type="text" name="productid" id="productid" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="productname">Product Name</label>
                    <input type="text" name="productname" id="productname" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="categoryid">Category Id</label>
                    <input type="text" name="categoryid" id="categoryid" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" autocomplete="off" required>
                </div>
                <!-- <div class="field input">
                    <label for="image">Image</label>
                    <input type="image" name="image" id="image" autocomplete="off" required>
                </div> -->
                <div class="field input">
                    <label for="discription">Discription</label>
                    <input type="text" name="discription" id="discription" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    View list of products <a href="hone.php">Home Page</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>