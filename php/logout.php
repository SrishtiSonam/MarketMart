<?php
      include("/connection.php");
      session_start();
      session_destroy();
      header("Location: ../index.php");
      mysqli_query($con, "delete from requests");
?>