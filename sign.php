<?php
include ("connectdb.php");
if (isset($_POST['submit'])){
    $user=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT * FROM user WHERE Username='$user'";
    $msq=mysqli_query($connect,$sql);
    if (!($msq->num_rows>0)){
        $insr="INSERT INTO user (id,Username,Password) VALUES ('','$user','$password')";
        $msql=mysqli_query($connect,$insr);
        if($msql){
            echo "<script>alert('Registration Success.')</script>";
            $_POST['username']="";
            $_POST['password']="";
            $user="";
            $password="";
        } 
        else{
            echo "<script>alert('Oops Something Is Wrong')";
        }
    }
    else {
        echo "<script>alert('Username has been taken')</script";
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
   
    <div class="sign">
    <h2 style="margin-bottom:20px;">Sign Up</h2>
     <form href="sign.php" method="POST">
        <div class="for">
            <label name="username">
                <p>Username</p>

            </label> <br>
            <input type="text" name="username"  required>

        </div>
        <div class="for">
        <label name="username" class="secret">
               <p>Password

               </p>            
             </label> <br>
            <input type="text" name="password" style="-webkit-text-security:square;" required>

        </div>
        <div class="butt">
    <button name="submit">Sign Up</button>
    </div>
    <div class="register">
    <p style="text-align:left;margin-top:5px;">Already Registered? <a href="login.php">Login</a></p>
  </div>
     </form>
    </div>
</div>
</body>
</html>