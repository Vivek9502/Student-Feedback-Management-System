<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="stu.css">
</head>
<body>
    <div class="login-container">
        <form id="login-form" method="post" action="stu.php" class="login-form">
            <h2>Login</h2>
            <div class="input-group">
                <label for="username">Roll Number:</label>
                <input type="text" id="username" name="rollno" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <p id="error-message" class="error-message"></p>
            </div>
            <button name="stu_log" type="submit">Login</button>
        </form> 
    </div>
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","");
if(isset($_POST["stu_log"])){
    $rollno=$_POST['rollno'];
    $password=$_POST['password']; 
    session_start();
    $_SESSION['rollno']=$_POST['rollno'];
    $sql="SELECT * FROM project.student WHERE rollno='$rollno'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $resultPassword=$row['password'];
        if($password==$resultPassword)
        {
            header('Location:stulogin.php');
        }
        else{
            echo "<script>
            alert('Login Unsuccessful');
            </script>";
        }
    }

}
?>
