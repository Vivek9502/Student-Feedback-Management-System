<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="falogin.css">
</head>
<body>
    <div class="login-container">
        <form id="login-form" class="login-form" action="man.php" method="post">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username">Management ID:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <p id="error-message" class="error-message"></p>
            </div>
            <button name="man_login">Login</button>
        </form>

    </div>

    
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","");
if(isset($_POST["man_login"])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql="SELECT * FROM project.man WHERE id='$username'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $resultPassword=$row['password'];
        if($password==$resultPassword)
        {
            header('Location:mana.php'); 
        }
        else{
            echo"<script>
            alert('Login Unsuccessful');
            </script>";
        }

    }

}
?>
