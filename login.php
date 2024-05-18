<?php
include ("connectdb.php");
if(isset($_POST['submit'])){
  $user=$_POST['Username'];
  $password=$_POST['Password'];
  $msql="SELECT * FROM user WHERE Username='$user' AND Password = '$password'";
  $row=mysqli_query($connect,$msql);
  if ($row->num_rows>0){
    $ro=mysqli_fetch_array($row);
    session_start();
    $_SESSION['nama']=$ro['Username'];
    header("location:homepage.php");
  }
  else {
    echo "<script>alert('Login Failed')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxuryLaundry</title>
    <link href="style.css" rel="stylesheet">

</head>
<body>
  <div class="content">
  <div class="login">
  <h2 style="margin-bottom:5px;">Login</h2>
  <form action="login.php" method="POST">
   <div class="for">
   
    <label name="Username">
      <p>
      Username </p>

    </label><br>
    <input type="text" name="Username" id="Username" required>
   </div>
   <div class="for">
    <label name="Password"><p>Password </p>
     
    </label><br>
    <input type="text" name="Password" id="Password" style="-webkit-text-security:square;" required>
   </div>
   <div class="butt">
    <button name="submit">Login</button>
    </div>
  
  </form>
  <div class="register">
    <p style="text-align:left;margin-top:5px;">Not Registered? <a href="sign.php">Sign Up</a></p>
  </div>
    </div>

    
  </div>

</body>
</html>


