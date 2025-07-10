<?php
$conn = mysqli_connect("localhost","root","");
if(isset($_POST["stu_log"])){
    $rollno=$_POST['rollno'];
    $password=$_POST['password']; 
    $sql="SELECT * FROM project.student WHERE rollno='$rollno'";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $resultPassword=$row['password'];
        if($password==$resultPassword)
        {
            header('Location:stulogin.html');
        }
        else{
            echo"<script>
            alert('Login Unsuccessful');
            </script>";
        }
    }

}
?>